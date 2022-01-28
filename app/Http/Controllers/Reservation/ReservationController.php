<?php

namespace App\Http\Controllers\Reservation;

use App\Exports\SalesReportExport;
use App\Exports\ReservationReportExport;
use App\Exports\CustomerReportExport;
use App\Exports\AllotmentExport;
use App\Http\Controllers\Controller;
use App\Mail\ReservationEmail;
use App\Models\Customer\Customer;
use App\Models\Inquiry\Inquiry;
use App\Models\Product\Product;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Room\Type;
use App\Models\Setting\Setting;
use Carbon\Carbon;
use DataTables;
use DateTime;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReservationController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    // data profile setting
    public function setting()
    {
        return Setting::first();
    }

    public function index()
    {
        $query = "SELECT * FROM `room_reservation` WHERE rsvp_checkin = CURDATE() and rsvp_status = 'Payment received'";

        $room_reservations = DB::select(DB::raw($query));
        $product_reservation = ProductRsvp::where('rsvp_date_reserve', DB::raw("CURDATE()"))
                            ->where('rsvp_status', "Payment received")
                            ->with('product')
                            ->with('customer')
                            ->get();
        $inquiry_total = Inquiry::where('inq_event_start', DB::raw("CURDATE()"))->get();

        $room_today = count($room_reservations);
        $product_today = count($product_reservation);
        $inquiry_today = count($inquiry_total);
        $setting = $this->setting();
        return view('main_page.reservation.index', get_defined_vars());
    }

    public function customer_data($start_date = NULL, $end_date = NULL)
    {
        $start_date = Input::get('start_date', $start_date);
        $end_date = Input::get('end_date', $end_date);

        $query = "SELECT
            customer_id,
            cust_email,
            SUBSTR(MAX(cust_name),
            20) last_register_name,
            SUBSTR(MAX(cust_phone),
            20) last_phone_number,
            COUNT(customer_id) AS total_reservation,
            MAX(create_at) AS last_reserve
        FROM
            (
            SELECT
                customer_id,
                customer.cust_email,
                CONCAT(create_at, ' ', rsvp_cust_name) AS cust_name,
                CONCAT(create_at, ' ', rsvp_cust_phone) AS cust_phone,
                create_at
            FROM
                room_reservation
            JOIN customer ON customer_id = customer.id
            WHERE
                customer_id IS NOT NULL AND rsvp_status IN(
                    'Payment received',
                    'Rescheduled',
                    'Refunded'
                )
            UNION
        SELECT
            customer_id,
            customer.cust_email,
            CONCAT(create_at, ' ', rsvp_cust_name) AS cust_name,
            CONCAT(create_at, ' ', rsvp_cust_phone) AS cust_phone,
            create_at
        FROM
            product_rsvp
        JOIN customer ON customer_id = customer.id
        WHERE
            customer_id IS NOT NULL AND rsvp_status IN(
                'Payment received',
                'Rescheduled',
                'Refunded'
            )
        UNION
        SELECT
            customer_id,
            customer.cust_email,
            CONCAT(create_at, ' ', inq_cust_name) AS cust_name,
            CONCAT(create_at, ' ', inq_cust_phone) AS cust_phone,
            create_at
        FROM
            inquiry
        JOIN customer ON customer_id = customer.id
        WHERE
            customer_id IS NOT NULL
        ) a
        WHERE create_at BETWEEN '" . $start_date . "' AND '" . $end_date . "'
        GROUP BY
            customer_id,cust_email";
        $data = DB::select(DB::raw($query));
        return $data;
    }

    public function today_room_data()
    {
        $today = Carbon::parse(Carbon::now())->format("Y-m-d");

        $query = "SELECT * FROM `room_reservation` left join payment on room_reservation.booking_id = payment.booking_id
        WHERE rsvp_checkin = CURDATE() and rsvp_status = 'Payment received' order by create_at DESC ;";

        $reservations = DB::select(DB::raw($query));
        foreach ($reservations as $key => $value) {
            $customer = Customer::where('id', $value->customer_id)->first();
            $value->customer = $customer;
        }
        return Datatables::of($reservations)->make(true);
    }

    public function room_data()
    {
        $query = "SELECT *, payment.* from room_reservation left join payment on room_reservation.booking_id = payment.booking_id
                where rsvp_payment <> '' or customer_id not in (null, '') order by create_at DESC ;";

        $reservations = DB::select(DB::raw($query));
        foreach ($reservations as $key => $value) {
            $customer = Customer::where('id', $value->customer_id)->first();
            $value->customer = $customer;
        }

        return Datatables::of($reservations)->make(true);
    }

    public function room_data_success($start_date = NULL, $end_date = NULL)
    {
        $room = Type::get();
        $start_date = Input::get('start_date', $start_date);
        $end_date = Input::get('end_date', $end_date);

        $select = "SUM(rsvp_grand_total) AS gross_sales,
        SUM(rsvp_tax) AS total_tax,
        SUM(rsvp_service) AS total_service,
        SUM(
            rsvp_total_amount_room + rsvp_total_amount_extrabed
        ) AS nett_sales,
        (
        SELECT
            COUNT(DISTINCT reservation_id)
        FROM
            room_rsvp
        WHERE
            rsvp_date_reserve BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND rsvp_status in ('Payment received', 'Cancellation fee')
        ) AS total_transaction";

        $total_reservation = RoomRsvp::select(DB::raw($select))
            ->whereBetween('rsvp_date_reserve', [$start_date, $end_date])
            ->whereIn('rsvp_status', array('Payment received', 'Cancellation fee'))
            ->first();
        $data = [
            "gross_sales" => $total_reservation->gross_sales,
            "total_tax" => $total_reservation->total_tax,
            "total_service" => $total_reservation->total_service,
            "nett_sales" => $total_reservation->nett_sales,
            "total_transaction" => $total_reservation->total_transaction,
        ];
        $data["room"] = [];

        $query = "SELECT *,
                    concat(totalroom,' x ' ,room_name) AS reserved_rooms
                    FROM room_reservation
                        LEFT JOIN room_type ON room_reservation.room_id = room_type.id
                        LEFT JOIN (
                            SELECT
                                `booking_id`,
                                SUM(`rsvp_total_room`) as 'TotalRoom'
                            FROM room_rsvp
                                WHERE
                                rsvp_status IN ('Payment received' ,'Cancellation fee')
                                AND
                                rsvp_date_reserve BETWEEN '" . $start_date . "' AND '" . $end_date . "'
                                GROUP BY `booking_id`
                                -- ORDER BY create_at DESC
                            ) totalroom
                        ON room_reservation.booking_id = totalroom.booking_id
                        WHERE
                        rsvp_status IN ('Payment received' ,'Cancellation fee')
                        AND
                        rsvp_checkin BETWEEN '" . $start_date . "' AND '" . $end_date . "'
                        ORDER BY create_at ASC";

        $rsvp = DB::select(DB::raw($query));
        $data['rsvp'] = $rsvp;

        foreach ($room as $key => $value) {
            $id = $value->id;

            $select = "SUM(rsvp_total_room) AS total_room_sales,
            SUM(rsvp_grand_total) AS room_revenue,
            SUM(rsvp_tax) AS tax_collected,
            SUM(rsvp_service) AS service_collected,
            SUM(
                rsvp_total_amount_room + rsvp_total_amount_extrabed
            ) AS nett_sales";
            $total_sales = RoomRsvp::select(DB::raw($select))
                ->where("room_id", $id)
                ->whereBetween('rsvp_date_reserve', [$start_date, $end_date])
                ->whereIn('rsvp_status', array('Payment received', 'Cancellation fee'))
                ->first();
            $temp = [
                "room_type" => $value->room_name,
                "total_room_sales" => $total_sales->total_room_sales,
                "average_rate" => floor($total_sales->room_revenue / ($total_sales->total_room_sales == 0 ? 1 : $total_sales->total_room_sales)),
                "room_revenue" => $total_sales->room_revenue,
                "tax_collected" => $total_sales->tax_collected,
                "service_collected" => $total_sales->service_collected,
                "nett_sales" => $total_sales->nett_sales,
            ];

            array_push($data['room'], $temp);
        }

        return $data;
    }

    public function product_inquiry_data()
    {
        $data = Inquiry::where('customer_id', '<>', 'NULL')->with('customer')->with('product')->with('function_room')->with('other_request')->orderBy('create_at', 'DESC')->get();

        foreach ($data as $key => $value) {
            if ($value['inq_type'] == 0) {
                $value['product_name'] = 'General Inquiry';
            } else {
                $value['product_name'] = $value['product']->product_name;

            }
        }

        return Datatables::of($data)->make(true);
    }

    public function product_inquiry_today()
    {
        $data = Inquiry::where('customer_id', '<>', 'NULL')
                ->where('inq_event_start', DB::raw("CURDATE()"))
                ->with('customer')
                ->with('product')
                ->with('function_room')
                ->with('other_request')
                ->orderBy('create_at', 'DESC')
                ->get();

        foreach ($data as $key => $value) {
            if ($value['inq_type'] == 0) {
                $value['product_name'] = 'General Inquiry';
            } else {
                $value['product_name'] = $value['product']->product_name;

            }
        }

        return Datatables::of($data)->make(true);
    }

    public function inquiry_data_success($start_date = NULL, $end_date = NULL)
    {
        $inquiry = Product::where('sales_inquiry', 1)->get();

        $start_date = Input::get('start_date', $start_date);
        $end_date = Input::get('end_date', $end_date);

        $select = "COUNT(DISTINCT reservation_id) AS total_transaction";

        $total_reservation = Inquiry::select(DB::raw($select))
            ->whereBetween('inq_event_start', [$start_date, $end_date])
            ->first();
        $data = [
            "total_transaction" => $total_reservation->total_transaction,
        ];
        $select = "inquiry.*, customer.cust_email, product.product_name";
        $rsvp = Inquiry::select(DB::raw($select))
            ->leftJoin('product', 'inquiry.product_id', '=', 'product.id')
            ->join('customer', 'inquiry.customer_id', '=', 'customer.id')
            ->whereBetween('inq_event_start', [$start_date, $end_date])
            ->orderBy('inq_event_start')
            ->get();

        $data['rsvp'] = $rsvp;
        return $data;
    }

    public function product_data()
    {
        $reservations = ProductRsvp::where('booking_id', '!=', '')->whereNotIn('customer_id', ['', 'NULL'])
            ->orderBy('create_at', 'DESC')->with('product')->with('customer')->with('payment')->get();
        return Datatables::of($reservations)->make(true);
    }

    public function product_reservation_today()
    {
        $reservations = ProductRsvp::where('customer_id', '<>', 'NULL')->where('rsvp_date_reserve', DB::raw("CURDATE()"))->where('rsvp_status', "Payment received")->with('product')->with('customer')->orderBy('create_at', 'DESC')->get();
        return Datatables::of($reservations)->make(true);
    }

    public function product_data_success($start_date = NULL, $end_date = NULL)
    {
        $product = Product::where('sales_inquiry', 0)->get();

        $start_date = Input::get('start_date', $start_date);
        $end_date = Input::get('end_date', $end_date);

        $select = "SUM(rsvp_grand_total) AS gross_sales,
        SUM(rsvp_tax) AS total_tax,
        SUM(rsvp_service) AS total_service,
        SUM(rsvp_total_amount) AS nett_sales,
        (
        SELECT
            COUNT(DISTINCT reservation_id)
        FROM
            product_rsvp
        WHERE
            rsvp_date_reserve BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND rsvp_status in ('Payment received', 'Cancellation fee')
        ) AS total_transaction";

        $total_reservation = ProductRsvp::select(DB::raw($select))
            ->whereBetween('rsvp_date_reserve', [$start_date, $end_date])
            ->whereIn('rsvp_status', array('Payment received', 'Cancellation fee'))
            ->first();
        $data = [
            "gross_sales" => $total_reservation->gross_sales,
            "total_tax" => $total_reservation->total_tax,
            "total_service" => $total_reservation->total_service,
            "nett_sales" => $total_reservation->nett_sales,
            "total_transaction" => $total_reservation->total_transaction,
        ];
        $select = "product_rsvp.*, customer.cust_email, product.product_name";
        $rsvp = ProductRsvp::select(DB::raw($select))
            ->join('product', 'product_rsvp.product_id', '=', 'product.id')
            ->join('customer', 'product_rsvp.customer_id', '=', 'customer.id')
            ->whereBetween('rsvp_date_reserve', [$start_date, $end_date])
            ->whereIn('rsvp_status', array('Payment received', 'Cancellation fee'))
            ->orderBy('rsvp_date_reserve')
            ->get();
        $data['rsvp'] = $rsvp;
        $data["product"] = [];
        foreach ($product as $key => $value) {
            $id = $value->id;

            $select = "SUM(rsvp_amount_pax) AS total_product_sales,
            SUM(rsvp_grand_total) AS product_revenue,
            SUM(rsvp_tax) AS tax_collected,
            SUM(rsvp_service) AS service_collected,
            SUM(rsvp_total_amount) AS nett_sales";
            $total_sales = ProductRsvp::select(DB::raw($select))
                ->where("product_id", $id)
                ->whereBetween('rsvp_date_reserve', [$start_date, $end_date])
                ->whereIn('rsvp_status', array('Payment received', 'Cancellation fee'))
                ->first();
            $temp = [
                "product_name" => $value->product_name,
                "total_product_sales" => $total_sales->total_product_sales,
                "average_rate" => floor($total_sales->product_revenue / ($total_sales->total_product_sales == 0 ? 1 : $total_sales->total_product_sales)),
                "product_revenue" => $total_sales->product_revenue,
                "tax_collected" => $total_sales->tax_collected,
                "service_collected" => $total_sales->service_collected,
                "nett_sales" => $total_sales->nett_sales,
            ];

            array_push($data['product'], $temp);
        }

        return $data;
    }

    public function room_this_month_data()
    {
        $firstDay = Carbon::now()->firstOfMonth();
        $lastDay = Carbon::now()->lastOfMonth();
        $reservation =
        RoomRsvp::select('room_rsvp.id', 'room_rsvp.reservation_id', 'room_rsvp.rsvp_date_reserve', 'room_type.room_name', 'room_rsvp.rsvp_customer_name', 'room_rsvp.rsvp_total_room')
            ->whereBetween('rsvp_date_reserve', [$firstDay, $lastDay])
            ->where('rsvp_status', 'Payment received')
            ->join('room_type', 'room_type.id', '=', 'room_rsvp.room_id')
            ->orderBy('room_rsvp.rsvp_date_reserve')->get();
        return $reservation;
    }

    public function product_data_today()
    {
        $today = Carbon::parse(Carbon::now())->format("Y-m-d");
        $reservation = ProductRsvp::where('rsvp_status', 'Payment received')->where('rsvp_date_reserve', $today)->with('product')->get();
        return $reservation;
    }

    public function refundReschedule(Request $request)
    {
        if ($request['reservation_type'] == "Room") {
            $msg = $this->room_refundReschedule($request);
        } elseif ($request['reservation_type'] == "Product") {
            $msg = $this->product_refundReschedule($request);
        } elseif ($request['reservation_type'] == "Email") {
            $msg = $this->resendEmail($request);
            return response()->json(["status" => 200, "msg" => $msg]);

        } else {
            return redirect()->route('reservation.index')->with('warning', '404 Not Found :(');
        }

        return redirect()->route('reservation.index')->with('status', $msg);
    }

    public function room_refundReschedule(Request $request)
    {
        $rsvp = RoomRsvp::where('reservation_id', $request['reservation_id'])->orderBy('rsvp_date_reserve')->get()->toArray();
        if (isset($request['btn_cancel'])) {
            foreach ($rsvp as $key => $value) {
                if ($key === array_key_first($rsvp)) {
                    $today = Carbon::now();
                    $dateFirst = Carbon::parse($value['rsvp_date_reserve']);
                    $dayDiff = $dateFirst->diffInDays($today);
                    if ($dayDiff < 7) {
                        $status = "Cancellation fee";
                    } else {
                        $status = "Refunded";
                    }
                    RoomRsvp::where('reservation_id', $request['reservation_id'])
                        ->where('rsvp_date_reserve', $value['rsvp_date_reserve'])
                        ->update(array('rsvp_status' => $status));
                } else {
                    RoomRsvp::where('reservation_id', $request['reservation_id'])
                        ->where('rsvp_date_reserve', $value['rsvp_date_reserve'])
                        ->update(array('rsvp_status' => 'Refunded'));
                }
            }
            return 'Update status to Cancel for reservation ' . $request['reservation_id'] . ' success';
        } else if (isset($request['btn_reschedule'])) {
            RoomRsvp::where('reservation_id', $request['reservation_id'])
                ->update(array('rsvp_status' => 'Rescheduled'));
            return 'Update status to Rescheduled for reservation ' . $request['reservation_id'] . ' success';
        }
    }

    public function product_refundReschedule(Request $request)
    {
        if (isset($request['btn_cancel'])) {
            ProductRsvp::where('reservation_id', $request['reservation_id'])
                ->update(array('rsvp_status' => 'Refunded'));
            return 'Update status to Cancel for reservation ' . $request['reservation_id'] . ' success';
        } else if (isset($request['btn_reschedule'])) {
            ProductRsvp::where('reservation_id', $request['reservation_id'])
                ->update(array('rsvp_status' => 'Rescheduled'));
            return 'Update status to Rescheduled for reservation ' . $request['reservation_id'] . ' success';
        }
    }

    public function resendEmail(Request $request)
    {
        $from = $request['reservation_from'];
        $id = $request['reservation_id'];
        $booking_id = $request['booking_id'];

        if ($from == "ROOMS") {
            $query = DB::select('select * from room_reservation where reservation_id = ?', [$id]);
            $data = $query[0];

            $query = DB::select('select * from room_type where id = ?', [$data->room_id]);
            $data->room = $query[0];

            $query = DB::select('select * from customer where id = ?', [$data->customer_id]);
            $data->customer = $query[0];

            $query = DB::select('select * from room_photo where room_id = ? LIMIT 1', [$data->room_id]);
            $data->room->photo = $query;

            $start = Carbon::parse($data->rsvp_checkin);
            $end = Carbon::parse($data->rsvp_checkout);
            $totalStay = $start->diffInDays($end);
            $data->rsvp_checkin = Carbon::parse($data->rsvp_checkin)->isoFormat('dddd, DD MMMM YYYY');
            $data->rsvp_checkout = Carbon::parse($data->rsvp_checkout)->isoFormat('dddd, DD MMMM YYYY');
            $data->total_stay = $totalStay;


        } elseif ($from == "PRODUCTS") {
            $data = ProductRsvp::where('reservation_id', $id)->with('product')->with('customer')->first();
            $data->rsvp_date_reserve = Carbon::parse($data->rsvp_date_reserve)->isoFormat('dddd, DD MMMM YYYY');
            $to = $data['customer']->cust_email;
            switch ($data['product']->category) {
                case '1':
                    $data['product']->category = "Recreation";
                    break;
                case '2':
                    $data['product']->category = "AllySea a SPA";
                    break;
                case '3':
                    $data['product']->category = "MICE";
                    break;
                case '4':
                    $data['product']->category = "Wedding";
                    break;

                default:
                    # code...
                    break;
            }
        }

        $query = DB::select('select * from payment where booking_id = ?', [$booking_id]);
        $data->payment = $query[0];

        $data->payment->transaction_time = Carbon::parse($data->payment->transaction_time)->isoFormat('LLLL');
        switch ($data->payment->payment_type) {
            case 'credit_card':
                $data->payment->payment_type = "Credit Card";
                break;
            case 'bank_transfer':
                $data->payment->payment_type = "Bank Transfer";
                break;
            case 'bca_clickpay':
                $data->payment->payment_type = "Bca KlikPay";
                break;
            case 'cimb_clicks':
                $data->payment->payment_type = "CIMB Clicks";
                break;
            case 'danamon_online':
                $data->payment->payment_type = "Danamon Online Banking";
                break;
            case 'echannel':
                $data->payment->payment_type = "Mandiri Bill Payment";
                break;

            default:
                # code...
                break;
        }
        $setting = Setting::first();
        $data->from = $from;
        $data->voucher_attachment = $this->template_voucher($data, $setting);
        $data->receipt_attachment = $this->template_receipt($data, $setting);
        $to = $request['reservation_email'];

        if ($data->rsvp_status == "Payment received") {
            Mail::to($to)->send(new ReservationEmail($data, $setting));
        }

        return 'Voucher send to ' . $to . ' success';
    }

    public function template_voucher($data, $setting)
    {
        $pdf = PDF::loadview('templates.template_voucher', get_defined_vars());
        return $pdf->stream('voucher_template.pdf');
    }

    public function template_receipt($data, $setting)
    {
        $pdf = PDF::loadview('templates.template_receipt', get_defined_vars());
        return $pdf->stream('receipt_template.pdf');
    }

    public function sales_export_excel(Request $request)
    {
        $start_date = Carbon::parse($request['date_start'])->format('Y-m-d');
        $end_date = Carbon::parse($request['date_end'])->format('Y-m-d');
        $rooms = $this->room_data_success($start_date, $end_date);
        $products = $this->product_data_success($start_date, $end_date);
        $data['rooms'] = json_decode(json_encode($rooms), true);
        $data['products'] = json_decode(json_encode($products), true);
        $export = new SalesReportExport($data);
        $today = Carbon::parse(Carbon::now())->isoFormat('MMMM Do YYYY');
        $name = "sales_report-" . $today . ".xlsx";
        return Excel::download($export, $name);
    }

    public function reservation_export_excel(Request $request)
    {
        $start_date = Carbon::parse($request['date_start'])->format('Y-m-d');
        $end_date = Carbon::parse($request['date_end'])->format('Y-m-d');
        $rooms = $this->room_data_success($start_date, $end_date);
        $products = $this->product_data_success($start_date, $end_date);
        $inquiry = $this->inquiry_data_success($start_date, $end_date);
        $data['rooms'] = json_decode(json_encode($rooms), true);
        $data['products'] = json_decode(json_encode($products), true);
        $data['inquiry'] = json_decode(json_encode($inquiry), true);
        $export = new ReservationReportExport($data);
        $today = Carbon::parse(Carbon::now())->isoFormat('MMMM Do YYYY');
        $name = "reservation_report-" . $today . ".xlsx";
        return Excel::download($export, $name);
    }

    public function customer_export_excel(Request $request)
    {
        $start_date = Carbon::parse($request['date_start'])->format('Y-m-d');
        $end_date = Carbon::parse($request['date_end'])->format('Y-m-d');
        $customer = $this->customer_data($start_date, $end_date);
        $data['customer'] = json_decode(json_encode($customer), true);
        $export = new CustomerReportExport($data);
        $today = Carbon::parse(Carbon::now())->isoFormat('MMMM Do YYYY');
        $name = "customer_report-" . $today . ".xlsx";
        return Excel::download($export, $name);
    }


    public function allotment_export_excel(Request $request)
    {
        $allotment = json_decode($request['allotment_data'], true);
        $data['allotment'] = $allotment;
        $export = new AllotmentExport($data);
        $today = Carbon::parse(Carbon::now())->isoFormat('MMMM Do YYYY');
        $name = "allotment_report-" . $today . ".xlsx";
        return Excel::download($export, $name);
    }

}
