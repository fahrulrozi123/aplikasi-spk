<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\ReservationEmail;
use App\Mail\CustomerEmail;
use App\Models\Inquiry\Inquiry;
use App\Models\Payment\Payment;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Setting\Setting;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class NotificationController extends Controller
{
    public function payment_check()
    {
        $merchant_id		= 33519;
        $merchant_password 	= 'p@ssw0rd';

        $submerchant_id		= $merchant_id."0001";
        $merchant_user		= "bot".$merchant_id;

        $bill_no            = '6a092c9872118120';

        $signature = sha1(md5($merchant_user.$merchant_password.$bill_no));

        $client = new Client();

        $response = $client->post('https://dev.faspay.co.id/cvr/100004/10', [
            'json' => [
                'request'     => 'Pengecekan Status Pembayaran',
                'trx_id'      => '3351980200000455',
                'merchant_id' => $merchant_id,
                'bill_no'     => $bill_no,
                'signature'   => $signature
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function payment_notification(Request $request)
    {
        // $request             = $request['request'];
        // $transaction_id      = $request['trx_id'];
        // $merchant_id         = $request['merchant_id'];
        // $merchant            = $request['merchant'];
        // $booking_id          = $request['bill_no'];
        // $payment_reff        = $request['payment_reff'];
        // $payment_date        = $request['payment_date'];
        // $payment_status_code = $request['payment_status_code'];
        // $payment_status_desc = $request['payment_status_desc'];
        // $bill_total          = $request['bill_total'];
        // $payment_total       = $request['payment_total'];
        // $payment_channel_uid = $request['payment_channel_uid'];
        // $payment_channel     = $request['payment_channel'];
        // $signature           = $request['signature'];

        // $signature_key       = Payment::where('booking_id', $booking_id)->first();

        // if ($signature !== $signature_key) {
        //     return response()->json(["status" => 401, "message" => "Something went wrong"]);
        //     return redirect()->route('index')->with('warning', 'Something went wrong');
        // }

        // $data =
        //     [
        //     'transaction_id'     => $transaction_id,
        //     'booking_id'         => $booking_id,
        //     'merchant_id'        => $merchant_id,
        //     'transaction_status' => 'settlement',
        //     'status_code'        => payment_status_code,
        //     'payment_type'       => $payment_channel,
        //     'status_message'     => $payment_status_desc ,
        //     'signature_key'      => $signature_key,
        // ];

        // if (Payment::where('booking_id', $booking_id)->exists()) {
        //     Payment::where('booking_id', $booking_id)->update($data);
        // } else {
        //     Payment::insert($data);
        // }

        $date_now = Carbon::now()->format('Y-m-d H:i:s');
        $merchant_id	   = "33519";

        // dd($merchant_id);

        $data = [
            "response"      => "Payment Notification",
            "trx_id"        => "3351980200000448",
            "merchant_id"   => $merchant_id,
            "merchant"      => "Tripasysfo Development",
            "bill_no"       => "27eaeda83f9b4b66",
            "response_code" => "00",
            "response_desc" => "Sukses",
            "response_date" => $date_now
        ];

        return response()->json($data);


    }

    public function payment_success(Request $request)
    {
        $transaction = $request->all();
        if(!isset($transaction['id'])){
            $data = json_decode($transaction['response']);
            $transaction_id = $data->transaction_id;
        }else{
            $transaction_id = $transaction['id'];
        }
        if(!Payment::where('transaction_id', $transaction_id)->exists()){
            return redirect()->route('index')->with('warning', 'Transaction not found!');
        }
        $payment = Payment::where('transaction_id', $transaction_id)->first();
        $from = $payment->from_table;
        $id = $payment->rsvp_id;

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
            $data->rsvp_checkin = Carbon::parse($data->rsvp_checkin)->isoFormat('DD MMMM YYYY');
            $data->rsvp_checkout = Carbon::parse($data->rsvp_checkout)->isoFormat('DD MMMM YYYY');
            $data->total_stay = $totalStay;
            $data->person = $data->rsvp_adult.' Adult';
            if($data->rsvp_child > 0){
                $data->person .= ' & '.$data->rsvp_child.' Child';
            }
            $data = RoomRsvp::getInclusivePrice($data);
            $to = $data->customer->cust_email;

        } elseif ($from == "PRODUCTS") {
            $data = ProductRsvp::where('reservation_id', $id)->with('product')->with('customer')->first();
            $data->rsvp_date_reserve = Carbon::parse($data->rsvp_date_reserve)->isoFormat('DD MMMM YYYY');
            $data = ProductRsvp::getInclusivePrice($data);
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
        return view('visitor_site.payment.payment', get_defined_vars());
    }

    public function payment_unfinish()
    {
        return $this->payment_check();
    }

    public function payment_error()
    {
        return $this->payment_check();
    }

    public function resendEmail($from, $id)
    {

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
            $data = RoomRsvp::getInclusivePrice($data);

            $to = $data->customer->cust_email;

            //FOR MARKETING
            $data->date = "(Check In) ".$data->rsvp_checkin.", (Check Out) ".$data->rsvp_checkout;

        } elseif ($from == "PRODUCTS") {
            $data = ProductRsvp::where('reservation_id', $id)->with('product')->with('customer')->first();
            $data->rsvp_date_reserve = Carbon::parse($data->rsvp_date_reserve)->isoFormat('dddd, DD MMMM YYYY');
            $data = ProductRsvp::getInclusivePrice($data);
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

            //FOR MARKETING
            $data->date = $data->rsvp_date_reserve;

        }else if($from == "INQUIRY"){
            $setting = Setting::first();
            $data = Inquiry::where('reservation_id', $id)->first();
            $data->from = $from;
            $data->date = Carbon::parse($data->inq_event_start)->isoFormat('dddd, DD MMMM YYYY');
            $data->cust_name = $data->inq_cust_name;
            $data->rsvp_type = "Inquiry";
            $data->subject = 'Inquiry - '.$data->reservation_id;
            $customer = $data->customer->cust_email;

            $to = User::whereNull('deleted_at')->whereIn('level', [0, 1])->pluck('email')->toArray();
            // Mail::to($to[0])->cc($to)->send(new ReservationEmail($data));

            // EMAIL FOR MARKETING/ADMIN
            foreach ($to as $key => $value) {
                Mail::to($value)->send(new ReservationEmail($data, $setting));
            }

            // EMAIL FOR CUSTOMER
            Mail::to($customer)->send(new CustomerEmail($data, $setting));
            return 0;
        }

        $query = DB::select('select * from payment where rsvp_id = ?', [$id]);
        $data->payment = $query[0];

        $data->payment->transaction_time = Carbon::parse($data->payment->transaction_time)->isoFormat('LLLL');
        switch ($data->payment->payment_type) {
            case 'credit_card':
                $data->payment->payment_type = "Credit Card";
                break;
            case 'bank_transfer':
                $data->payment->payment_type = "Bank Transfer";
                break;
            case 'bca_klikpay':
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

        if ($data->rsvp_status == "Payment received") {
            Mail::to($to)->send(new ReservationEmail($data, $setting));
        }

        //FOR MARKETING
        $data->from = "RSVP MARKETING";
        $data->cust_name = $data->rsvp_cust_name;
        $data->rsvp_type = "Reservation";
        $data->subject = 'Reservation - '.$data->reservation_id;
        $to = User::whereNull('deleted_at')->whereIn('level', [0, 1])->pluck('email')->toArray();
        foreach ($to as $key => $value) {
            Mail::to($value)->send(new ReservationEmail($data, $setting));
        }

        // return 'Resend Email for reservation ' . $request['reservation_id'] . ' success';
    }

    public function template_email()
    {
        $pdf = PDF::loadview('templates.template_email');
        return $pdf->stream('email_Template.pdf');

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

}
