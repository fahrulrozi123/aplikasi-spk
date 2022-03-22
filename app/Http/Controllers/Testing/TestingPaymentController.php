<?php

namespace App\Http\Controllers\Testing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Carbon\Carbon;
use GuzzleHttp\Client;

use App\Models\Setting\Setting;
use App\Models\Payment\Payment;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Product\Rsvp as ProductRsvp;

class TestingPaymentController extends Controller
{
    public function paymentChannel()
    {
        $merchant          = config('faspay.merchant');
        $merchant_id	   = config('faspay.merchantId');
        $merchant_password = config('faspay.merchantPassword');
        $merchant_user	   = 'bot'.$merchant_id;
        $signature         = sha1(md5($merchant_user.$merchant_password));

        $client = new Client();

        // check url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/100001/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://debit-sandbox.faspay.co.id/cvr/100001/10';
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

        // print result
        // $paymentChannels  = $response->getBody()->getContents();

        // $listPaymentChannels = json_decode($paymentChannels, true);
        // dd($listPaymentChannels);
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

    public function testNotificationDebit()
    {
        // select booking_id room or products
        $booking_id          = "85118fdb2e9975ac";

        // rooms
        $data                = RoomRsvp::where('booking_id', $booking_id)->first();

        // products
        // $data             = ProductRsvp::where('booking_id', $booking_id)->first();

        $payment             = Payment::where('booking_id', $booking_id)->first();
        $transaction_id      = $payment->transaction_id;
        $merchant_id         = $payment->merchant_id;
        $payment_status_desc = "Payment Sukses";
        $payment_channel     = $payment->payment_type;

        // validate signature
        $merchant_id	     = config('faspay.merchantId');
        $merchant_password   = config('faspay.merchantPassword');
        $merchant_user	     = 'bot'.$merchant_id;
        $bill_no             = $payment->booking_id;
        $payment_status_code = 2;

        $signature           = $this->generateSignatureDebit($merchant_user,$merchant_password,$bill_no,$payment_status_code);;
        // fail signature
        // $signature        = generateRandomString();

        return view('layouts.testing_payment_debit', get_defined_vars());
    }

    public function testNotificationCredit()
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
        $payment_date   = Carbon::now();
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

        // check url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/100004/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://debit-sandbox.faspay.co.id/cvr/100004/10';
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

        // return $response->getBody()->getContents();
        $results = $response->getBody()->getContents();
        $contents = json_decode($results, true);
        dd($contents);
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

    public function checkPaymentKlikpay()
    {
        $setting = $this->setting();

        return view('layouts.payment_check_klikpay', get_defined_vars());
    }

    public function generateSignatureDebit($merchant_user,$merchant_password,$bill_no,$payment_status_code)
    {
        return sha1(md5($merchant_user.$merchant_password.$bill_no.$payment_status_code));
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
