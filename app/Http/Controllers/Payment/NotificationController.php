<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Room\Type;
use App\Mail\ReservationEmail;
use App\Mail\CustomerEmail;
use App\Models\Inquiry\Inquiry;
use App\Models\Payment\Payment;
use App\Models\Product\Product;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Admin\User;
use App\Models\Customer\Customer;

use DB;
use PDF;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function payment_check(Request $request)
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

    public function payment_check_credit()
    {
        $signaturecc=sha1('##'.strtoupper('test_migs_non').'##'.strtoupper('abcde').'##2017091850745##1000.00##'.'0'.'##');
        $post = array(
            "TRANSACTIONTYPE"      => '4',
            "RESPONSE_TYPE"        => '3',
            "MERCHANTID"           => 'test_migs_non',
            "PAYMENT_METHOD"       => '1',
            "MERCHANT_TRANID"      => '2017091850745',
            "TRANSACTIONID"        => '9E69AD15-4AB0-43AE-B37B-8FD276E24155',
            "AMOUNT"               => '1000.00',
            "SIGNATURE"            => $signaturecc
        );

        $post   = http_build_query($post);
        $url    = "https://fpg.faspay.co.id/payment/api";
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

        $result = curl_exec($ch);
        // print_r($result);
        curl_close($ch);

        $arr1 = explode(';',$result);

        $res_arr = array();

        foreach($arr1 as $val)
        {
            $arr2=explode('=',$val);
            $res_arr[$arr2[0]]=$arr2[1];
        }

        dd($res_arr);

        // dd($res_arr['ERR_CODE']);
    }

    public function payment_notification(Request $request)
    {
        // dd($request->all());
        // from faspay
        $transaction_id      = $request['trx_id'] ?: null;
        $merchant_id         = $request['merchant_id'] ?: null;
        $merchant            = $request['merchant'] ?: null;
        $booking_id          = $request['bill_no'] ?: null;
        $payment_reff        = $request['payment_reff'] ?: null;
        $payment_date        = $request['payment_date'] ?: null;
        $payment_status_code = $request['payment_status_code'] ?: null;
        $payment_status_desc = $request['payment_status_desc'] ?: null;
        $bill_total          = $request['bill_total'] ?: null;
        $payment_total       = $request['payment_total'];
        $payment_channel_uid = $request['payment_channel_uid'] ?: null;
        $payment_channel     = $request['payment_channel'] ?: null;
        $signature           = $request['signature'] ?: null;

        // from database payment
        $data_payment        = Payment::where('booking_id', $booking_id)->first();
        $from                = $data_payment->from_table;

        // validate signature
        $merchant_id	     = config('faspay.merchantId');
        $merchant_password   = config('faspay.merchantPassword');
        $merchant_user	     = 'bot'.$merchant_id;
        $bill_no             = $request['bill_no'] ?: null;

        $valid_signature_key = $this->generateSignatureDebit($merchant_user,$merchant_password,$bill_no,$payment_status_code);

        if ($signature !== $valid_signature_key) {
            return response()->json(["status" => 401, "message" => "Something went wrong"]);
            return redirect()->route('index')->with('warning', 'Something went wrong');
        }

        $data =
            [
            'transaction_id'     => $transaction_id,
            'booking_id'         => $booking_id,
            'merchant_id'        => $merchant_id,
            'transaction_status' => 'settlement',
            'settlement_time'    => $payment_date,
            'payment_reff'       => $payment_reff,
            'status_code'        => $payment_status_code,
            'payment_type'       => $payment_channel,
            'status_message'     => $payment_status_desc,
            'signature_key'      => $signature,
        ];

        if (Payment::where('booking_id', $booking_id)->exists()) {
            Payment::where('booking_id', $booking_id)->update($data);
        } else {
            Payment::insert($data);
        }

        // if ($payment_status_code == "2") {
            if ($from == "ROOMS") {

                // generated rsvp_id room
                $rsvp = RoomRsvp::where('booking_id', $booking_id)->first();
                $checkIn = $rsvp->rsvp_date_reserve;

                $getRoom = Type::where('id', $rsvp->room_id)->first();

                $rsvpId = rand($min = 1, $max = 99999);
                $reservationId = $this->generate_room_id($rsvpId, $checkIn, $getRoom->room_name);
                while ($reservationId == false) {
                    $rsvpId = rand($min = 1, $max = 99999);
                    $reservationId = $this->generate_room_id($rsvpId, $checkIn, $getRoom->room_name);
                }

                RoomRsvp::where('booking_id', $booking_id)->update([
                    'reservation_id' => $reservationId,
                    'rsvp_payment'   => $payment_channel,
                    'rsvp_status'    => 'Payment received',
                ]);

                $rsvp_id = Payment::where('booking_id', $booking_id)->first();
                $this->resendEmail($from, $rsvp_id->booking_id);

            } else if ($from == "PRODUCTS") {

                // generated rsvp_id products
                $rsvp = ProductRsvp::where('booking_id', $booking_id)->first();
                $productsId = $rsvp->product_id;

                $productData = Product::where('id', $productsId)->first();

                // generated rsvp_id products
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $productData->rsvp_date_reserve, $productData->product_name, $productData->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $productData->rsvp_date_reserve, $productData->product_name, $productData->sales_inquiry);
                }

                ProductRsvp::where('booking_id', $booking_id)->update([
                    'reservation_id' => $reservation_id,
                    'rsvp_payment'   => $payment_channel,
                    'rsvp_status'    => 'Payment received',
                ]);

                $rsvp_id = Payment::where('booking_id', $booking_id)->first();
                $this->resendEmail($from, $rsvp_id->booking_id);
            }
        // }

        $date_now           =  Carbon::now()->format('Y-m-d H: i: s');
        $merchant_id        =  config('faspay.merchantId');

        $data               =  [
            "response"      => "Payment Notification",
            "trx_id"        => $transaction_id,
            "merchant_id"   => $merchant_id,
            "merchant"      => config('faspay.merchant'),
            "bill_no"       => $booking_id,
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

    public function credit_notification(Request $request)
    {
        // dd($request->all());
        $transaction_id      = $request['TRANSACTIONID'] ?: null;
        $merchant_id         = $request['MERCHANTID'] ?: null;
        $booking_id          = $request['MERCHANT_TRANID'] ?: null;
        $status              = $request['TXN_STATUS'] ?: null;
        $payment_date        = $request['TRANDATE'] ?: null;
        $fraud_status        = $request['FRAUD_STATUS'] ?: null;
        $status_message      = $request['USR_MSG'] ?: null;
        $payment_total       = $request['AMOUNT'] ?: null;
        $signature           = $request['SIGNATURE'] ?: null;

        // validate signature
        $merchant_id         = config('faspay.merchantIdCredit');
        $merchant_password   = config('faspay.merchantPasswordCredit');
        $merchant_tranid     = $request['MERCHANT_TRANID'] ?: null;
        $amount              = $request['AMOUNT'] ?: null;

        // $valid_signature_key = $this->generateSignatureCredit($merchant_id,$merchant_password,$merchant_tranid,$amount);

        // if ($signature !== $valid_signature_key) {
        //     return response()->json(["status" => 401, "message" => "Something went wrong"]);
        //     return redirect()->route('index')->with('warning', 'Something went wrong');
        // }

        // cek status payment success or cancel
        if ($status == "S") {
            $transaction_status = 'settlement';
        } else {
            $transaction_status = 'Failed';
        }

        $data =
            [
            'transaction_id'     => $transaction_id,
            'merchant_id'        => $merchant_id,
            'booking_id'         => $booking_id,
            'transaction_status' => $transaction_status,
            'settlement_time'    => $payment_date,
            'status_message'     => $status_message,
            'gross_amount'       => $payment_total,
            'signature_key'      => $signature,
        ];

        if (Payment::where('booking_id', $booking_id)->exists()) {
            Payment::where('booking_id', $booking_id)->update($data);
        } else {
            Payment::insert($data);
        }

        // from payment
        $data_payment        = Payment::where('booking_id', $booking_id)->first();
        $valid_signature_key = $data_payment->signature_key;
        $from                = $data_payment->from_table;

        // cek status payment success or cancel
        if ($status == "S") {
            if ($from == "ROOMS") {

                // generated rsvp_id room
                $rsvp = RoomRsvp::where('booking_id', $booking_id)->first();
                $checkIn = $rsvp->rsvp_date_reserve;

                $getRoom = Type::where('id', $rsvp->room_id)->first();

                // customer data
                $customer  = Customer::where('id', $rsvp->customer_id)->first();

                // check room reservation_id empty or not
                $checkRsvpId = DB::table('room_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
                $valueCheckRsvpId = $checkRsvpId->reservation_id;

                if ($valueCheckRsvpId == "") {
                    $rsvpId = rand($min = 1, $max = 99999);
                    $reservationId = $this->generate_room_id($rsvpId, $checkIn, $getRoom->room_name);

                    while ($reservationId == false) {
                        $rsvpId = rand($min = 1, $max = 99999);
                        $reservationId = $this->generate_room_id($rsvpId, $checkIn, $getRoom->room_name);
                    }
                } else {
                    $dataRsvpId = DB::table('room_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
                    $reservationId = $dataRsvpId->reservation_id;
                }

                RoomRsvp::where('booking_id', $booking_id)->update([
                    'rsvp_status'    => 'Payment received',
                    'reservation_id' => $reservationId,
                    'rsvp_payment'   => 'Credit Card'
                ]);

                $status = RoomRsvp::where('booking_id', $booking_id)->first();

                if ($status->rsvp_status == "Payment received") {
                    $rsvp_id = Payment::where('booking_id', $booking_id)->first();
                    $this->resendEmail($from, $rsvp_id->booking_id);
                }

                // data view step 3
                $query = DB::select('select * from room_reservation where booking_id = ?', [$booking_id]);
                $data = $query[0];

                $query = DB::select('select * from room_type where id = ?', [$rsvp->room_id]);
                $data->room = $query[0];

                $start = Carbon::parse($data->rsvp_checkin);
                $end = Carbon::parse($data->rsvp_checkout);
                $totalStay = $start->diffInDays($end);
                $data->rsvp_checkin = Carbon::parse($data->rsvp_checkin)->isoFormat('DD MMMM YYYY');
                $data->rsvp_checkout = Carbon::parse($data->rsvp_checkout)->isoFormat('DD MMMM YYYY');
                $data->total_stay = $totalStay;

                // dd($data);

            } else if ($from == "PRODUCTS") {

                // generated rsvp_id products
                $rsvp = ProductRsvp::where('booking_id', $booking_id)->first();
                $productsId = $rsvp->product_id;

                $productData = Product::where('id', $productsId)->first();

                // customer data
                $customer  = Customer::where('id', $rsvp->customer_id)->first();

                /// check product reservation_id empty or not
                $checkRsvpId = DB::table('product_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
                $valueCheckRsvpId = $checkRsvpId->reservation_id;

                if ($valueCheckRsvpId == "") {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $productData->rsvp_date_reserve, $productData->product_name, $productData->sales_inquiry);

                    while ($reservation_id == false) {
                        $rsvp_id = rand($min = 1, $max = 99999);
                        $reservation_id = $this->generate_product_id($rsvp_id, $productData->rsvp_date_reserve, $productData->product_name, $productData->sales_inquiry);
                    }
                } else {
                    $dataRsvpId = DB::table('product_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
                    $reservation_id = $dataRsvpId->reservation_id;
                }

                ProductRsvp::where('booking_id', $booking_id)->update([
                    'rsvp_status'    => 'Payment received',
                    'reservation_id' => $reservation_id,
                    'rsvp_payment'   => 'Credit Card'
                ]);

                $status = ProductRsvp::where('booking_id', $booking_id)->first();

                if ($status->rsvp_status == "Payment received") {
                    $rsvp_id = Payment::where('booking_id', $booking_id)->first();
                    $this->resendEmail($from, $rsvp_id->booking_id);
                }

                // data view step 3
                $data = ProductRsvp::where('booking_id', $booking_id)->with('product')->with('customer')->first();
                $data->rsvp_date_reserve = Carbon::parse($data->rsvp_date_reserve)->isoFormat('DD MMMM YYYY');

                // dd($data);
            }
        } else if ($status == "E") {
            if ($from == "ROOMS") {
                // canceled room
                $rsvp = RoomRsvp::where('booking_id', $booking_id)->first();

                RoomRsvp::where('booking_id', $booking_id)->update([
                    'rsvp_status'    => 'Payment Expired',
                    'rsvp_payment'   => 'Credit Card'
                ]);

            } else if ($from == "PRODUCTS") {
                // canceled product
                $rsvp = ProductRsvp::where('booking_id', $booking_id)->first();

                ProductRsvp::where('booking_id', $booking_id)->update([
                    'rsvp_status'    => 'Payment Expired',
                    'rsvp_payment'   => 'Credit Card'
                ]);
            }
        }

        $setting = $this->setting();

        return view('visitor_site.reserve.credit_notification', get_defined_vars());
    }

    public function generate_room_id($id, $date, $roomName)
    {
        $generateId = '';
        switch ($id) {
            case $id < 10:
                $generateId .= "0000" . $id;
                break;
            case $id < 100:
                $generateId .= "000" . $id;
                break;
            case $id < 1000:
                $generateId .= "00" . $id;
            case $id < 10000:
                $generateId .= "0" . $id;
                break;

            default:
                $generateId .= $id;
                break;
        }
        $generateId .= "RSVRM";
        switch ($roomName) {
            case 'Deluxe Business':
                $generateId .= "1";
                break;
            case 'Deluxe Recreational':
                $generateId .= "2";
                break;
            case 'Deluxe Mountain':
                $generateId .= "3";
                break;
            case 'Anindita Suite':
                $generateId .= "4";
                break;
            case 'Arinandra Suite':
                $generateId .= "5";
                break;
            case 'Amanda Suite':
                $generateId .= "6";
                break;
            case 'Audi Cottage':
                $generateId .= "7";
                break;

            default:
                # code...
                break;
        }
        switch (Carbon::parse($date)->format('m')) {
            case '1':
                $generateId .= "I";
                break;
            case '2':
                $generateId .= "II";
                break;
            case '3':
                $generateId .= "III";
                break;
            case '4':
                $generateId .= "IV";
                break;
            case '5':
                $generateId .= "V";
                break;
            case '6':
                $generateId .= "VI";
                break;
            case '7':
                $generateId .= "VII";
                break;
            case '8':
                $generateId .= "VIII";
                break;
            case '9':
                $generateId .= "IX";
                break;
            case '10':
                $generateId .= "X";
                break;
            case '11':
                $generateId .= "XI";
                break;
            case '12':
                $generateId .= "XII";
                break;
            default:
                # code...
                break;
        }

        $generateId .= Carbon::parse($date)->format('Y');
        $cek = RoomRsvp::where('reservation_id', $generateId)->first();
        if (isset($cek) > 0) {
            return false;
        } else {
            return $generateId;
        }
    }

    public function generate_product_id($id, $date, $productName, $inquiry)
    {
        $generateId = "";
        switch ($id) {
            case $id < 10:
                $generateId .= "0000" . $id;
                break;
            case $id < 100:
                $generateId .= "000" . $id;
                break;
            case $id < 1000:
                $generateId .= "00" . $id;
                break;
            case $id < 10000:
                $generateId .= "0" . $id;
                break;

            default:
                $generateId .= $id;
                break;
        }
        if ($inquiry == 0) {
            $generateId .= "RSVPD";
        } else {
            $generateId .= "INQPD";
        }
        switch ($productName) {
            case '1 Day Trip':
                $generateId .= "REC1";
                break;
            case 'Aromatherapy':
                $generateId .= "ALS2";
                break;
            case 'Massage':
                $generateId .= "ALS2";
                break;
            case 'Residential Package':
                $generateId .= "MIC1";
                break;
            case 'Non Residential Package':
                $generateId .= "MIC2";
                break;
            case 'Premium Wedding Package':
                $generateId .= "WED1";
                break;
            case 'Silver Wedding Package':
                $generateId .= "WED2";
                break;
            case 'Wedding Information':
                $generateId .= "WED3";
                break;
            case 'General Inquiry':
                $generateId .= "GEN1";
                break;

            default:
                # code...
                break;
        }
        switch (Carbon::parse($date)->format('m')) {
            case '1':
                $generateId .= "I";
                break;
            case '2':
                $generateId .= "II";
                break;
            case '3':
                $generateId .= "III";
                break;
            case '4':
                $generateId .= "IV";
                break;
            case '5':
                $generateId .= "V";
                break;
            case '6':
                $generateId .= "VI";
                break;
            case '7':
                $generateId .= "VII";
                break;
            case '8':
                $generateId .= "VIII";
                break;
            case '9':
                $generateId .= "IX";
                break;
            case '10':
                $generateId .= "X";
                break;
            case '11':
                $generateId .= "XI";
                break;
            case '12':
                $generateId .= "XII";
                break;
            default:
                # code...
                break;
        }
        $generateId .= Carbon::parse($date)->format('Y');
        if ($inquiry == 0) {
            $cek = ProductRsvp::where('reservation_id', $generateId)->first();
        } else {
            $cek = Inquiry::where('reservation_id', $generateId)->first();
        }
        if (isset($cek)) {
            return false;
        } else {
            return $generateId;
        }
    }

    public function resendEmail($from, $id)
    {
        if ($from == "ROOMS") {
            $query = DB::select('select * from room_reservation where booking_id = ?', [$id]);
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

            $data = ProductRsvp::where('booking_id', $id)->with('product')->with('customer')->first();

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
        }

        $query = DB::select('select * from payment where booking_id = ?', [$id]);
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

        $setting = $this->setting();
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

    public function generateSignatureDebit($merchant_user,$merchant_password,$bill_no,$payment_status_code)
    {
        return sha1(md5($merchant_user.$merchant_password.$bill_no.$payment_status_code));
    }

    public function generateSignatureCredit($merchant_id,$merchant_password,$merchant_tranid,$amount)
    {
        return sha1('##'.strtoupper($merchant_id).'##'.strtoupper($merchant_password).'##'.$merchant_tranid.'##'.$amount.'##'.'0'.'##');
    }
}
