<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Customer\Customer;
use App\Models\Inquiry\Inquiry;
use App\Models\Product\Product;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Room\Type;
use App\Models\Setting\Setting;
use App\Models\Payment\Payment;

use Carbon\Carbon;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Session;
use \Waavi\Sanitizer\Sanitizer;
use App\Mail\CheckoutEmail;
use Illuminate\Support\Facades\Mail;


class PaymentController extends Controller
{
    public function setting()
    {
        return Setting::first();
    }

    public function paymentChannelPayment()
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

    public function listPaymentChannel()
    {
        $paymentChannels = $this->paymentChannelPayment();
        $listPaymentChannels = json_decode($paymentChannels, true);

        $name_payment = '818';
        $key = array_search($name_payment, array_column($listPaymentChannels['payment_channel'], 'pg_code'));
        $result = $listPaymentChannels['payment_channel'][$key]['pg_name'];

        dd($result);
    }

    public function reserve_room(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $booking_id = $input['booking_id'];
        $rsvp = RoomRSvp::where('booking_id', $input['booking_id'])->first();
        $data = json_decode($input['data'], true);
        $id_type = ['Identity Card', 'Driver License', 'Passport'];

        if ($data['type'] == "customer") {
            $validator = Validator::make($data, [
                'cust_name' => 'required|string|max:50',
                'cust_id_type' => 'required|string',
                'cust_id_num' => 'required|string|max:30',
                'cust_email' => 'required|email|max:50',
                'cust_phone' => 'required|numeric',
                'guest_name' => 'string',
                'additional_request' => 'string',
            ],
            [
                'cust_name.required' => 'Full Name field is required',
                'cust_name.string' => 'Full Name field only can contain letter not number',
                'guest_name.string' => 'Guest Name field only can contain letter not number',
                'cust_name.max' => 'Full Name field max only 50 character',
                'cust_email.required' => 'Email field is required',
                'cust_email.email' => 'Email field only can fill with Email',
                'cust_phone.numeric' => 'Phone Number field only can fill with numeric',
                'cust_phone.digits_between' => 'Phone Number field length Maximal 30',
                'cust_id_type.required' => 'Identification Card field is required',
                'cust_id_num.required' => 'Identification Number field is required',
                'cust_id_num.numeric' => 'Identification Number field only can contain numeric',
                'cust_id_num.digits_between' => 'Identification Number field length Maximal 30',
            ]);

            if ($validator->fails()) {
                return response()->json(["status" => 422, "msg" => $validator->messages()->first()]);
            }

            if (!in_array($data['cust_id_type'], $id_type)) {
                return response()->json(["status" => 422, "msg" => "Identification Card not found !"]);
            }

            $filters = [
                'cust_name' => 'trim|escape|capitalize',
                'cust_email' => 'trim|escape|lowercase',
                'cust_id_type' => 'trim|escape|capitalize',
                'guest_name' => 'trim|escape|capitalize',
                'cust_phone' => 'digit',
                'cust_id_num' => 'digit',
                'additional_request' => 'strip_tags',
            ];

            $sanitizer = new Sanitizer($data, $filters);
            $sanitizer = $sanitizer->sanitize();
            $cust_email = $sanitizer['cust_email'];

            if (Customer::where('cust_email', $cust_email)->exists()) {
                $customer_id = Customer::where('cust_email', $cust_email)->pluck('id')->first();
            } else {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $customer_id = $hex;
                while (Customer::where('id', $customer_id)->exists()) {
                    $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                    $hex = bin2hex($bytes);
                    $customer_id = $hex;
                }

                $customer = [
                    'id' => $customer_id,
                    'cust_email' => $cust_email,
                ];

                Customer::insert($customer);
            }

            $rsvp = RoomRsvp::where('booking_id', $booking_id)->orderBy('rsvp_date_reserve', 'ASC')->first();
            $checkIn = $rsvp->rsvp_date_reserve;

            $getRoom = Type::where('id', $rsvp->room_id)->first();

            RoomRsvp::where('booking_id', $booking_id)->update([
                'customer_id' => $customer_id,
                'rsvp_cust_name' => $sanitizer['cust_name'],
                'rsvp_cust_phone' => $sanitizer['cust_phone'],
                'rsvp_cust_idtype' => $sanitizer['cust_id_type'],
                'rsvp_cust_idnumber' => $sanitizer['cust_id_num'],
                'rsvp_guest_name' => $sanitizer['guest_name'],
                'rsvp_special_request' => $sanitizer['additional_request'],
            ]);

            // dd($rsvp);

            return response()->json(["status" => 200, "href" => "tab2-2", "customer_name" => $sanitizer['cust_name'], "customer_email" => $sanitizer['cust_email'], "booking_id" => $input['booking_id'], "tab" => "2", "text" => "Payment Information"]);

        } else {
            return response()->json(["status" => 422, "msg" => "Something went wrong"]);
        }
    }

    public function room_checkout(Request $request)
    {
        // dd($request->all());
        $input               = $request->all();
        $data                = $input['data'];
        $booking_id          = $input['booking_id'];
        $payment_channel     = $input['payment_channel'];
        $bill_total          = $data['total_price'].'00';

        $booking             = RoomRSvp::where('booking_id', $input['booking_id'])->first();
        $email               = Customer::where('id', $booking->customer_id)->first();

        // user
        $merchant_id	     = config('faspay.merchantId');
        $merchant_password   = config('faspay.merchantPassword');
        $merchant_user	     = 'bot'.$merchant_id;

        // search payment channel
        $paymentChannels     = $this->paymentChannelPayment();
        $listPaymentChannels = json_decode($paymentChannels, true);
        $name_payment        = $payment_channel;
        $key                 = array_search($name_payment, array_column($listPaymentChannels['payment_channel'], 'pg_code'));
        $result              = $listPaymentChannels['payment_channel'][$key]['pg_name'];

        $bill_no	         = $booking->booking_id;
        $request             = 'Room Reservation of '.$bill_no;
        $cust_name           = $booking->rsvp_cust_name;
        $bill_date           = $booking->create_at;
        $bill_expired        = $booking->expired_at;
        $bill_desc           = 'Room Reservation of '.$bill_no;
        $signature	         = sha1(md5($merchant_user.$merchant_password.$bill_no));

        $client = new Client();

        // cek url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/300011/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://dev.faspay.co.id/cvr/300011/10';
        }

        $response = $client->post($url, [
            'json' => [
                'request'          => $request,
                'merchant_id'      => $merchant_id,
                'bill_no'          => $bill_no,
                'bill_date'        => $bill_date,
                'bill_expired'     => $bill_expired,
                'bill_desc'        => $bill_desc,
                'bill_currency'    => 'IDR',
                'bill_total'       => $bill_total,
                // 'cust_no'       => '500505',
                'cust_name'        => $cust_name,
                'payment_channel'  => $payment_channel,
                'terminal'         => '10',
                'email'            => $email->cust_email,
                'pay_type'         => '1',
                'item'             => [
                    'product'      => $data['total_rooms'] . "x " . $data['room_name'] . "x " . $data['total_days'] . " day(s)",
                    'qty'          => $data['total_rooms'],
                    'amount'       => $bill_total
                ],
                'reserve1'         => 'ROOMS',
                'signature'        => $signature
            ]
        ]);

        // return $response->getBody()->getContents();

        $data           = json_decode($response->getBody()->getContents(), true);
        $transaction_id = $data['trx_id'];

        Payment::create([
            'transaction_id'     => $data['trx_id'],
            'booking_id'         => $data['bill_no'],
            'merchant_id'        => $data['merchant_id'],
            'from_table'         => 'ROOMS',
            'gross_amount'       => $booking->rsvp_grand_total,
            'currency'           => 'IDR',
            'transaction_status' => 'pending',
            'transaction_time'   => $bill_date,
            'settlement_time'    => $bill_expired,
            'fraud_status'       => $data['response_desc'],
            'payment_type'       => $result,
            // 'approval_code'      => $approval_code,
            'status_code'        => $data['response_code'],
            'status_message'     => $data['response'],
            'signature_key'      => $signature,
        ]);

        RoomRsvp::where('booking_id', $booking_id)->update([
            'rsvp_payment'       => $result
        ]);

        // Email Checkout Confirmation
        $setting = Setting::first();
        $data    = RoomRSvp::where('booking_id', $input['booking_id'])->first();
        $data->subject = 'Booking - '.$data->booking_id;

        Mail::to($email->cust_email)->send(new CheckoutEmail($data, $setting));

        return response()->json(["status" => 200, "transaction_id" => $transaction_id, "payment_type" => $result, "href" => "tab2-3"]);
    }

    public function reserve_product(Request $request)
    {
        $input = $request->all();
        $booking_id = $input['booking_id'];
        $rsvp = ProductRsvp::where('booking_id', $input['booking_id'])->first();

        $data = json_decode($input['data'], true);
        $id_type = ['Identity Card', 'Driver License', 'Passport'];
        $productData = Product::where('id', $data['product_id'])->first();

        $data['time_reserve'] = $data['date_reserve'] . ' ' . $data['time_reserve'];
        $data['time_reserve'] = Carbon::parse($data['time_reserve'])->isoFormat('YYYY-MM-DD HH:mm');

        $validator = Validator::make($data, [
            'cust_name' => 'required|string|max:50',
            'cust_id_type' => 'required|string',
            'cust_id_num' => 'required|string|max:30',
            'cust_email' => 'required|email|max:50',
            'cust_phone' => 'required|numeric',
            'product_id' => 'required|exists:product,id',
            'amount_pax' => 'required|numeric|min:1|max:4',
            'date_reserve' => 'required|after_or_equal:today',
            'time_reserve' => 'required|date_format:Y-m-d H:i|after:1 hours',
            'additional_request' => 'string',
        ],
        [
            'cust_name.required' => 'Full Name field is required',
            'cust_name.string' => 'Full Name field only can contain letter not number',
            'guest_name.string' => 'Guest Name field only can contain string',
            'cust_name.max' => 'Full Name field max only 50 character',
            'cust_email.required' => 'Email field is required',
            'cust_email.email' => 'Email field only can fill with Email',
            'cust_phone.numeric' => 'Phone Number field only can fill with numeric',
            'cust_phone.digits_between' => 'Phone Number field length Maximal 30',
            'cust_id_type.required' => 'Identification Card field is required',
            'cust_id_num.required' => 'Identification Number field is required',
            'cust_id_num.numeric' => 'Identification Number field only can contain numeric',
            'cust_id_num.digits_between' => 'Identification Number field length Maximal 30',
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Product is not found',
            'amount_pax.required' => 'Amount Pax field is required',
            'amount_pax.numeric' => 'Amount Pax field is only can contain numeric',
            'amount_pax.min' => 'Amount Pax field minimal 1 Pax',
            'amount_pax.max' => 'Amount Pax field maximal 4 Pax',
            'date_reserve.required' => 'Product Reservation Date field is required',
            'date_reserve.after_or_equal' => 'Product Reservation Date field date cannot less than today',
            'time_reserve.after' => 'Product Reservation Time at least 1 hour from now',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 422, "msg" => $validator->messages()->first()]);
        }

        if (!in_array($data['cust_id_type'], $id_type)) {
            return response()->json(["status" => 422, "msg" => "Identification Card not found !"]);
        }

        $data['time_reserve'] = Carbon::parse($data['time_reserve'])->isoFormat('h:mm A');
        if ($data['type'] == "customer") {

            $filters = [
                'cust_name' => 'trim|escape|capitalize',
                'cust_email' => 'trim|escape|lowercase',
                'payment_type' => 'trim|escape|capitalize',
                'cust_phone' => 'digit',
                'cust_id_num' => 'digit',
                'amount_pax' => 'digit',
                'date_reserve' => 'trim|format_date:d M Y, Y-m-d',
                'payment_number' => 'digit',
                'additional_request' => 'strip_tags',

            ];

            $sanitizer = new Sanitizer($data, $filters);

            $sanitizer = $sanitizer->sanitize();

            $booking_id = $input['booking_id'];

            $rsvp_pax_price = $productData->product_price;

            $rsvp_amount_pax = $sanitizer['amount_pax'];
            $rsvp_total_amount = $rsvp_pax_price * $rsvp_amount_pax;

            $rsvp_service = floor($rsvp_total_amount * 0.1);
            $rsvp_tax = floor(($rsvp_total_amount + $rsvp_service) * 0.1);
            $rsvp_total_amount -= $rsvp_service + $rsvp_tax;

            $rsvp_pax_price = floor($rsvp_total_amount / $rsvp_amount_pax);

            $grandTotal = $rsvp_total_amount + $rsvp_tax + $rsvp_service;

            $cust_email = $sanitizer['cust_email'];

            if (Customer::where('cust_email', $cust_email)->exists()) {
                $customer_id = Customer::where('cust_email', $cust_email)->pluck('id')->first();
            } else {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $customer_id = $hex;
                while (Customer::where('id', $customer_id)->exists()) {
                    $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                    $hex = bin2hex($bytes);
                    $customer_id = $hex;
                }

                $customer = [
                    'id' => $customer_id,
                    'cust_email' => $cust_email,
                ];

                Customer::insert($customer);
            }

            ProductRsvp::where('booking_id', $booking_id)->update([
                // 'reservation_id' => $reservation_id,
                'customer_id' => $customer_id,
                'rsvp_date_reserve' => $sanitizer['date_reserve'],
                'rsvp_arrive_time' => $data['time_reserve'],
                'rsvp_cust_name' => $sanitizer['cust_name'],
                'rsvp_cust_phone' => $sanitizer['cust_phone'],
                'rsvp_cust_idtype' => $sanitizer['cust_id_type'],
                'rsvp_cust_idnumber' => $sanitizer['cust_id_num'],
                'rsvp_special_request' => $sanitizer['additional_request'],
                'rsvp_amount_pax' => $rsvp_amount_pax,
                'rsvp_pax_price' => $rsvp_pax_price,
                'rsvp_total_amount' => $rsvp_total_amount,
                'rsvp_tax' => $rsvp_tax,
                'rsvp_service' => $rsvp_service,
                'rsvp_tax_total' => ($rsvp_tax + $rsvp_service),
                'rsvp_grand_total' => $grandTotal,
            ]);

            return response()->json(["status" => 200, "href" => "tab2-2", "customer_name" => $sanitizer['cust_name'], "customer_email" => $sanitizer['cust_email'], "tab" => "2", "text" => "Payment Information"]);

        } elseif ($data['type'] == "credit" || $data['type'] == "bank") {
            return response()->json(["status" => 200, "msg" => $data['type'], "transaction" => $transaction]);
        }
    }

    public function product_checkout(Request $request)
    {
        // dd($request->all());
        $input               = $request->all();
        $data                = $input['data'];
        $booking_id          = $input['booking_id'];
        $payment_channel     = $input['payment_channel'];
        $bill_total          = $data['total_price'].'00';

        $booking             = ProductRSvp::where('booking_id', $input['booking_id'])->first();
        $email               = Customer   ::where('id', $booking->customer_id)->first();

        // user
        $merchant_id	     = config('faspay.merchantId');
        $merchant_password   = config('faspay.merchantPassword');
        $merchant_user	     = 'bot'.$merchant_id;

        // search payment channel
        $paymentChannels     = $this->paymentChannelPayment();
        $listPaymentChannels = json_decode($paymentChannels, true);
        $name_payment        = $payment_channel;
        $key                 = array_search($name_payment, array_column($listPaymentChannels['payment_channel'], 'pg_code'));
        $result              = $listPaymentChannels['payment_channel'][$key]['pg_name'];

        $bill_no	         = $booking->booking_id;
        $request             = 'Product Reservation of '.$bill_no;
        $cust_name           = $booking->rsvp_cust_name;
        $bill_date           = $booking->create_at;
        $bill_expired        = $booking->expired_at;
        $bill_desc           = 'Product Reservation of '.$bill_no;
        $signature	         = sha1(md5($merchant_user.$merchant_password.$bill_no));

        $client = new Client();

        // cek url endpoint production or development
        if(config('faspay.endpoint') == true) {
            $url = 'https://web.faspay.co.id/cvr/300011/10';
        } else if (config('faspay.endpoint') == false) {
            $url = 'https://dev.faspay.co.id/cvr/300011/10';
        }

        $response = $client->post($url, [
            'json' => [
                'request'          => $request,
                'merchant_id'      => $merchant_id,
                'bill_no'          => $bill_no,
                'bill_date'        => $bill_date,
                'bill_expired'     => $bill_expired,
                'bill_desc'        => $bill_desc,
                'bill_currency'    => 'IDR',
                'bill_total'       => $bill_total,
                // 'cust_no'       => '500505',
                'cust_name'        => $cust_name,
                'payment_channel'  => $payment_channel,
                'terminal'         => '10',
                'email'            => $email->cust_email,
                'pay_type'         => '1',
                'item'             => [
                    'product'      => $data['amount_pax'] . "x " . $data['product_name'],
                    'qty'          => $data['amount_pax'],
                    'amount'       => $bill_total
                ],
                'reserve1'         => 'PRODUCTS',
                'signature'        => $signature
            ]
        ]);

        // return $response->getBody()->getContents();

        $data           = json_decode($response->getBody()->getContents(), true);
        $transaction_id = $data['trx_id'];
        $product_total  = $booking->rsvp_grand_total;

        Payment::create([
            'transaction_id'     => $data['trx_id'],
            'merchant_id'        => $data['merchant_id'],
            'booking_id'         => $data['bill_no'],
            'from_table'         => 'PRODUCTS',
            'gross_amount'       => $booking->rsvp_grand_total,
            'currency'           => 'IDR',
            'transaction_status' => 'pending',
            'transaction_time'   => $bill_date,
            'settlement_time'    => $bill_expired,
            'fraud_status'       => $data['response_desc'],
            'payment_type'       => $result,
            // 'approval_code'      => $approval_code,
            'status_code'        => $data['response_code'],
            'status_message'     => $data['response'],
            'signature_key'      => $signature,
        ]);

        ProductRsvp::where('booking_id', $booking_id)->update([
            'rsvp_payment'       => $result
        ]);

        // Email Checkout Confirmation
        $setting = Setting::first();
        $data    = ProductRSvp::where('booking_id', $input['booking_id'])->first();
        $data->subject = 'Booking - '.$data->booking_id;

        Mail::to($email->cust_email)->send(new CheckoutEmail($data, $setting));

        return response()->json(["status" => 200, "transaction_id" => $transaction_id, "product_total" => $product_total, "payment_type" => $result, "href" => "tab2-3"]);
    }

    public function credit(Request $request)
    {
        $data        = $request['reserve_data'];
        $data        = json_decode($data);

        $data_amount = $data->amount;
        $booking_id  = $data->booking_id;
        $amount      = number_format( (float) $data_amount, 2, '.', '');
        $from        = $data->from;

        // insert payment
        $merchant_id = 'faspay_trial_4';
        $password    = 'kgrfH';
        $tranid      = $booking_id;

        $signaturecc = sha1('##'.strtoupper($merchant_id).'##'.strtoupper($password).'##'.$tranid.'##'.$amount.'##'.'0'.'##');

        if ($from == "ROOMS") {
            $booking      = RoomRSvp::where('booking_id', $booking_id)->first();
            $bill_date    = $booking->create_at;
            $bill_expired = $booking->expired_at;
            $from         = 'ROOMS';
            // customer
            $customer     = Customer::where('id', $booking->customer_id)->first();
            $email        = $customer->cust_email;
            $name         = $booking->rsvp_cust_name;
        } else {
            $booking      = ProductRSvp::where('booking_id', $booking_id)->first();
            $bill_date    = $booking->create_at;
            $bill_expired = $booking->expired_at;
            $from         = 'PRODUCTS';
            // customer
            $customer     = Customer::where('id', $booking->customer_id)->first();
            $email        = $customer->cust_email;
            $name         = $booking->rsvp_cust_name;
        }

        Payment::create([
            // 'transaction_id'     => $data['trx_id'],
            'booking_id'         => $booking_id,
            'merchant_id'        => $merchant_id,
            'from_table'         => $from,
            'gross_amount'       => $amount,
            'currency'           => 'IDR',
            'transaction_status' => 'pending',
            'transaction_time'   => $bill_date,
            'settlement_time'    => $bill_expired,
            'fraud_status'       => 'Sukses',
            'payment_type'       => 'credit_card',
            // 'approval_code'      => $approval_code,
            'status_code'        => '00',
            'status_message'     => 'Transmisi Info Detil Pembelian',
            'signature_key'      => $signaturecc,
        ]);

        $string = '<form method="post" name="form" action="https://fpgdev.faspay.co.id/payment">';
            $post = array(
                "TRANSACTIONTYPE"               => '1',
                "RESPONSE_TYPE"	                => '2',
                "LANG" 			                => '',
                "MERCHANTID"                    => $merchant_id,  //*   // MERCHANT ID
                "PAYMENT_METHOD"                => '1', //*
                "TXN_PASSWORD" 	                => $password, //Transaction password  ajgbi
                "MERCHANT_TRANID"               => $tranid,   //*
                "CURRENCYCODE"	                => 'IDR', //*
                "AMOUNT"		                => $amount, //*
                "CUSTNAME"                      => $name, //*
                "CUSTEMAIL"		                => $email, //*
                "RETURN_URL"                    => 'http://horisonultimabandung.tripasysfo.com/credit-notification', //*
                "SIGNATURE" 	                => $signaturecc, //*
                "BILLING_ADDRESS"				=> 'bekasi',
                "BILLING_ADDRESS_CITY"			=> 'bekasi',
                "BILLING_ADDRESS_REGION"		=> 'bekasi',
                "BILLING_ADDRESS_STATE"			=> 'bekasi pusat6',
                "BILLING_ADDRESS_POSCODE"		=> '10712',
                "BILLING_ADDRESS_COUNTRY_CODE"	=> 'ID',
                "RECEIVER_NAME_FOR_SHIPPING"	=> 'ega',
                "SHIPPING_ADDRESS" 				=> 'bekasi air enam',
                "SHIPPING_ADDRESS_CITY" 		=> 'bekasi tengah',
                "SHIPPING_ADDRESS_REGION"		=> 'bekasi tengah',
                "SHIPPING_ADDRESS_STATE"		=> 'bekasi tengah',
                "SHIPPING_ADDRESS_POSCODE"		=> 'bekasi tengah',
                "SHIPPING_ADDRESS_COUNTRY_CODE" => 'bekasi tengah',
                "SHIPPINGCOST"					=> '0.00',
                "PHONE_NO" 						=> '43654657687',
                "MREF1"							=> 'tes',
                "MREF2" 						=> 'testing',
                "MREF3"							=> 'Tas;2;3000000',
                "MREF4"							=> '',
                "MREF5"							=> '',
                "MREF6"							=> '',
                "MREF7"							=> '',
                "MREF8"							=> '',
                "MREF9"							=> '',
                "MREF10"						=> '',
                "MPARAM1" 						=> '',// direct, isi dengan direct
                "MPARAM2" 						=> '',
                "CUSTOMER_REF"	 				=> '',
                "FRISK1"						=> '',
                "FRISK2"						=> '',
                "DOMICILE_ADDRESS"				=> '',
                "DOMICILE_ADDRESS_CITY"			=> '',
                "DOMICILE_ADDRESS_REGION"		=> '',
                "DOMICILE_ADDRESS_STATE"		=> '',
                "DOMICILE_ADDRESS_POSCODE" 		=> '',
                "DOMICILE_ADDRESS_COUNTRY_CODE" => '',
                "DOMICILE_PHONE_NO"	 			=> '',
                "handshake_url"					=> '',
                "handshake_param"				=> '',
                "style_merchant_name"           => 'black',
                "style_order_summary"           => 'black',
                "style_order_no"                => 'black',
                "style_order_desc"              => 'black',
                "style_amount"                  => 'black',
                "style_background_left"         => '#fff',
                "style_button_cancel"           => 'grey',
                "style_font_cancel"             => 'red',
                //harus url yg lgsg ke gambar
                "style_image_url"               => 'https://tirtasanitaresort.com/user/1599209847_5f520177f30bd.jpg',
            );

            // $string = '<form method="post" name="form" action="https://fpgdev.faspay.co.id/payment">';  // yang diubah URLnya ke prod apa dev
            if ($post != null) {
                foreach ($post as $name=>$value) {
                    $string .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
                }
            }

        $string .= '</form>';
        $string .= '<script> document.form.submit();</script>';

        echo $string;
        exit;
    }

    public function xpress(Request $request)
    {
        $merchant_id	   = 33519;
		$merchant_user	   = "bot".$merchant_id;

		$merchant_name	   = "Test"; // akan di provide oleh faspay per merchant
        $merchant_password = 'p@ssw0rd';
        $bill_no	       = date('YmdGis');
        $bill_total        = 300000;

        $signature	       = $this->generateSignature($merchant_user,$merchant_password,$bill_no,$bill_total);
        // die(var_dump($signature, $bill_total));

        $products = array(
            array(
                'product'   => 'Bunga',
                'qty'       => 1,
                'amount'    => 450000
            ),
            array(
                'product'   => 'Coklat',
                'qty'       => 2,
                'amount'    => 500000
            )
        );

        $client = new Client();

        $response =  $client->request('GET', 'https://dev.faspay.co.id/xpress/payment', [
            "merchant_id"				=> $merchant_id,
			"merchant_name"				=> $merchant_name,
			"order_id" 			    	=> $bill_no,
			"order_reff"				=> $bill_no,
			"bill_date"					=> date("Y-m-d H:i:s"),
			"bill_expired"				=> date("Y-m-d H:i:s", strtotime("+1 day")),
			"bill_gross"				=> $bill_total,
			"bill_miscfee"				=> '0',
			"bill_total"				=> $bill_total,
			"bill_desc"					=> 'Pembelian barang',
			"custNo"					=> '01',
			"display_cust"				=> 'true',
			"custName"					=> 'Test',
			"custPhone"					=> '08561020121',
			"custEmail"					=> 'customertest@faspay.co.id',
			"billingAddress" 			=> 'Jl. Pintu Air Raya No 2A',
			"billingState"				=> 'Indonesia',
			"billingCity"				=> 'Jakarta Pusat',
			"billingRegion"				=> 'DKI Jakarta',
			"billingPostcode"			=> '10710',
			"billingCountryCode"		=> 'ID',
			"receiver_name"				=> 'Saya',
			"shippingAddress"			=> 'Jl. Pintu Air Raya No 2A',
			"shippingState"				=> 'Indonesia',
			"shippingCity"				=> 'Jakarta Pusat',
			"shippingRegion"			=> 'DKI JAKARTA',
			"shippingPostCode"			=> '10710',
			"products"					=> $products,
			"return_url"            => 'https://google.com',

			"term_condition"			=> 1,
			"signature"					=> $signature,
        ]);

        return $response->getBody()->getContents();
    }

    // uses regex that accepts any word character or hyphen in last name
    public function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

    public function generateSignature($merchant_user,$merchant_password,$bill_no,$bill_total)
    {
        return sha1(md5($merchant_user.$merchant_password.$bill_no.$bill_total));
    }

}
