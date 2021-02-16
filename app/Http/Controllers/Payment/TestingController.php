<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Setting\Setting;
use App\Models\Payment\Payment;

use DB;
use Session;
use Notification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Notifications\PushDemo;

class TestingController extends Controller
{
    public function testEmailRsvp()
    {
        $this->resendEmail("ROOMS", "75601RSVRM1VII2020");
    }

    public function testEmailInquiry()
    {
        $this->resendEmail("INQUIRY", "09162INQPDGEN1VIII2020");
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

    public function paymentNotificationDebit()
    {
        // select booking_id room or products
        $booking_id          = "a664ee74be8ea104";

        // rooms
        $data                = RoomRsvp::where('booking_id', $booking_id)->first();

        // products
        // $data             = ProductRsvp::where('booking_id', $booking_id)->first();

        $payment             = Payment::where('booking_id', $booking_id)->first();

        $transaction_id      = $payment->transaction_id;
        $merchant_id         = $payment->merchant_id;
        $payment_status_code = 2;
        $payment_status_desc = "Payment Sukses";
        $payment_channel     = "Mandiri Virtual Account";

        $signature           = $payment->signature_key;

        // signature_fail
        // $signature        = "40f0c967a94683207831ca3661ae7d6fa8aa0eec1f1e2f69c5806bab0616511";

        return view('layouts.testing_payment_debit', get_defined_vars());
    }

    public function paymentNotificationCredit()
    {
        // select booking_id room or products
        $booking_id     = "2631647d01eeea4c";

        // rooms
        $data           = RoomRsvp::where('booking_id', $booking_id)->first();

        // products
        // $data        = ProductRsvp::where('booking_id', $booking_id)->first();

        $payment        = Payment::where('booking_id', $booking_id)->first();

        $transaction_id = 'FF2A8743-4921-44CA-AEC5-E2B389A5246E';
        $merchant_id    = $payment->merchant_id;
        $payment_date   = Carbon     ::now();
        $fraud_status   = 'Sukses';
        $status_message = 'Transaction approved';

        $signature      = $payment->signature_key;

        // signature_fail
        // $signature   = "40f0c967a94683207831ca3661ae7d6fa8aa0eec1f1e2f69c5806bab0616511";

        return view('layouts.testing_payment_credit', get_defined_vars());
    }

    public function checkPaymentDebit()
    {
        $setting = $this->setting();

        return view('layouts.payment_check_debit', get_defined_vars());
    }

    public function resultPaymentDebit(Request $request)
    {
        $merchant_id	   = config('faspay.merchantId');
        $merchant_password = config('faspay.merchantPassword');
        $merchant_user	   = 'bot'.$merchant_id;
        $trx_id            = $request['trx_id'];
        $bill_no           = $request['bill_no'];
        $signature         = sha1(md5($merchant_user.$merchant_password.$bill_no));

        $client = new Client();

        // cek url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/100004/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://dev.faspay.co.id/cvr/100004/10';
        }

        $response = $client->post($url, [
            'json' => [
                'request'     => 'Pengecekan Status Pembayaran',
                'trx_id'      => $trx_id,
                'merchant_id' => $merchant_id,
                'bill_no'     => $bill_no,
                'signature'   => $signature
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function checkPaymentCredit()
    {
        $setting = $this->setting();

        return view('layouts.payment_check_credit', get_defined_vars());
    }

    public function resultPaymentCredit(Request $request)
    {
        $merchant_id = config('faspay.merchantIdCredit');
        $password    = config('faspay.merchantPasswordCredit');
        $tranid      = $request['tranid'];
        $amount      = $request['amount'];

        $signaturecc = sha1('##'.strtoupper($merchant_id).'##'.strtoupper($password).'##'.$tranid.'##'.$amount.'##'.'0'.'##');

        // dd($signaturecc);

        $post = array(
            "TRANSACTIONTYPE"      => '4',
            "RESPONSE_TYPE"        => '3',
            "MERCHANTID"           => $merchant_id,
            "PAYMENT_METHOD"       => '1',
            "MERCHANT_TRANID"      => $tranid,
            // "TRANSACTIONID"        => '53CBA232-D828-4676-9243-C3493B603CE0',
            "AMOUNT"               => $amount,
            "SIGNATURE"            => $signaturecc
        );

        $post   = http_build_query($post);
        $url    = "https://fpgdev.faspay.co.id/payment/api";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $result = curl_exec($ch);
        // print_r($result);
        // curl_close($ch);

        $result  = curl_exec($ch);
        curl_close($ch);
        $arr1    = explode(';',$result);
        $res_arr = array();

        foreach($arr1 as $val)
        {
            $arr2=explode('=',$val);
            $res_arr[$arr2[0]]=$arr2[1];
        }

        dd($res_arr);
    }

    public function paymentChannel()
    {
        $merchant          = config('faspay.merchant');
        $merchant_id	   = config('faspay.merchantId');
        $merchant_password = config('faspay.merchantPassword');
        $merchant_user	   = 'bot'.$merchant_id;
        $signature         = sha1(md5($merchant_user.$merchant_password));

        $client = new Client();

        // cek url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/100001/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://dev.faspay.co.id/cvr/100001/10';
        }

        $response = $client->post($url, [
            'json' => [
                'request'     => 'Request List of Payment Gateway',
                'merchant_id' => $merchant_id,
                'merchant'    => $merchant,
                'signature'   => $signature
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function onePaymentChannel()
    {
        $paymentChannels = $this->paymentChannel();

        // start one -list payment
        $listPaymentChannels = json_decode($paymentChannels, true);

        $name_payment = '818';
        $key = array_search($name_payment, array_column($listPaymentChannels['payment_channel'], 'pg_code'));
        $result = $listPaymentChannels['payment_channel'][$key]['pg_name'];

        dd($result);

        // start disable list payment
        // $list = json_decode($paymentChannels, true);
        // $listPaymentChannels = $list['payment_channel'];

        // return view('layouts.testing_disable_payment', get_defined_vars());
    }

    public function checkPaymentKlikpay()
    {
        $setting = $this->setting();

        return view('layouts.payment_check_klikpay', get_defined_vars());
    }
}
