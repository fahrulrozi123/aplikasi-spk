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
        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 94000, // no decimal allowed for creditcard
        );
        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => 2500000,
            'quantity' => 3,
            'name' => "Recreational - 1 Day Adventure",
        );

        // Optional
        $item2_details = array(
            'id' => 'a2',
            'price' => 3000000,
            'quantity' => 5,
            'name' => "Spa - Aromatherapy",
        );

        // Optional
        $item_details = array($item1_details, $item2_details);

        $full_name = $this->split_name("Muhammad Farhan");
        // Optional
        $customer_details = array(
            'first_name' => $full_name[0],
            'last_name' => $full_name[1],
            'email' => "farhan.ryukudo@gmail.com",
            'phone' => "081122334455",
            'billing_address' => '',
            'shipping_address' => '',
        );

        // Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        return redirect()->route('index');
        // return view('visitor_site.payment.index', get_defined_vars());
    }

    public function payment_notification(Request $request)
    {
        $orderId = $request['order_id'];
        $statusCode = $request['status_code'];
        $grossAmount = $request['gross_amount'];
        $serverKey = config('midtrans.midtrans.serverKey');
        $input = $orderId.$statusCode.$grossAmount.$serverKey;
        $signature = openssl_digest($input, 'sha512');
        $signatureKey = $request['signature_key'];

        if ($signatureKey !== $signature) {
            return response()->json(["status" => 401, "message" => "Something went wrong"]);
            return redirect()->route('index')->with('warning', 'Something went wrong');
        }

        $transaction_id = $request['transaction_id'] ?: null;
        $merchant_id = $request['merchant_id'] ?: null;
        $rsvp_id = $request['order_id'] ?: null;
        $gross_amount = $request['gross_amount'] ?: null;
        $currency = $request['currency'] ?: null;
        $transaction_status = $request['transaction_status'] ?: null;
        $transaction_time = $request['transaction_time'] ?: null;
        $settlement_time = $request['settlement_time'] ?: null;
        $fraud_status = $request['fraud_status'] ?: null;
        $payment_type = $request['payment_type'] ?: null;
        $approval_code = $request['approval_code'] ?: null;
        $status_code = $request['status_code'] ?: null;
        $status_message = $request['status_message'] ?: null;
        $signature_key = $request['signature_key'] ?: null;
        $from = $request['custom_field1'] ?: null;

        $data =
            [
            'transaction_id' => $transaction_id,
            'merchant_id' => $merchant_id,
            'rsvp_id' => $rsvp_id,
            'from_table' => $from,
            'gross_amount' => $gross_amount,
            'currency' => $currency,
            'transaction_status' => $transaction_status,
            'transaction_time' => $transaction_time,
            'settlement_time' => $settlement_time,
            'fraud_status' => $fraud_status,
            'payment_type' => $payment_type,
            'approval_code' => $approval_code,
            'status_code' => $status_code,
            'status_message' => $status_message,
            'signature_key' => $signature_key,
        ];

        switch ($payment_type) {
            case 'credit_card':
                $payment = "Credit Card";
                break;
            case 'bank_transfer':
                $payment = "Bank Transfer";
                break;
            case 'bca_klikpay':
                $payment = "Bca KlikPay";
                break;
            case 'cimb_clicks':
                $payment = "CIMB Clicks";
                break;
            case 'danamon_online':
                $payment = "Danamon Online Banking";
                break;
            case 'echannel':
                $payment = "Mandiri Bill Payment";
                break;

            default:
                # code...
                break;
        }

        if (Payment::where('rsvp_id', $rsvp_id)->exists()) {
            Payment::where('rsvp_id', $rsvp_id)->update($data);
        } else {
            Payment::insert($data);
        }
        if ($status_code == 200) {
            if ($from == "ROOMS") {

                RoomRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Payment received",
                ]);
            } else if ($from == "PRODUCTS") {
                ProductRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Payment received",
                ]);
            }
            $this->resendEmail($from, $rsvp_id);
        } else if ($status_code == 201) {
            if ($from == "ROOMS") {
                RoomRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Waiting for payment",
                ]);
            } else if ($from == "PRODUCTS") {
                ProductRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Waiting for payment",
                ]);
            }
        } else if ($status_code == 202 && $transaction_status == "expire") {
            if ($from == "ROOMS") {
                RoomRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Failed",
                ]);
            } else if ($from == "PRODUCTS") {
                ProductRsvp::where('reservation_id', $rsvp_id)->update([
                    'rsvp_payment' => $payment,
                    'rsvp_status' => "Failed",
                ]);
            }
        }

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
