<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\ReservationEmail;
use App\Mail\CustomerEmail;
use App\Models\Allotment\Allotment;
use App\Models\Customer\Customer;

// MODELS USED
use App\Models\FunctionRoom\FunctionRoom;
use App\Models\Inquiry\Inquiry;
use App\Models\Inquiry\OtherRequest;
use App\Models\Payment\Payment;
use App\Models\Product\Product;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Room\Type;
use App\Models\Visitor\Banner;
use App\Models\Visitor\News;
use App\Models\Admin\User;
use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;

use Carbon\Carbon;
use DB;
// END MODELS USED

use Illuminate\Support\Facades\Crypt;

//validator
use Illuminate\Support\Facades\Hash;
//Input Sanitizer
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;
use Session;
use \Waavi\Sanitizer\Sanitizer;

use App\Notifications\PushDemo;
use Notification;

class PaymentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.midtrans.is3ds');
    }

    // data profile setting
    public function setting()
    {
        return Setting::first();
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

    public function reserve_room(Request $request)
    {
        $input = $request->all();
        if (isset($request['forget_snap'])) {
            Session::forget('roomSnapToken');
            Session::forget('room_booking_id');
            return response()->json(["status" => 200, "msg" => "Success"]);

        }

        $booking_id = $input['booking_id'];
        $validate_booking_id = Session::get('room_booking_id');

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

            // if (Session::get('roomSnapToken') != null) {
            //     $snapToken = Session::get('roomSnapToken');
            //     return response()->json(["status" => 200, "href" => "tab2-2", "tab" => "2", "text" => "Payment Information", "snapToken" => $snapToken]);
            // }

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
                'customer_id' => $customer_id,
                "reservation_id" => $reservationId,
                'rsvp_cust_name' => $sanitizer['cust_name'],
                'rsvp_cust_phone' => $sanitizer['cust_phone'],
                'rsvp_cust_idtype' => $sanitizer['cust_id_type'],
                'rsvp_cust_idnumber' => $sanitizer['cust_id_num'],
                'rsvp_guest_name' => $sanitizer['guest_name'],
                'rsvp_special_request' => $sanitizer['additional_request'],
            ]);

            $order_id = DB::table('room_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();

            // Required
            $transaction_details = array(
                'order_id' => $order_id->reservation_id,
                'gross_amount' => $data['total_price'], // no decimal allowed for creditcard
            );
            // Optional
            $item1_details = array(
                'id' => '1',
                'price' => $data['total_room_price'],
                'quantity' => 1,
                'name' => $data['total_rooms'] . "x " . $data['room_name'] . " x " . $data['total_days'] . " day(s)",
            );

            // Optional
            $item2_details = array(
                'id' => '2',
                'price' => $data['total_extrabed_price'],
                'quantity' => 1,
                'name' => $data['total_extrabed'] . "x " ."Additional Extra Bed". " x " . $data['total_days'] . " day(s)",
            );

            // Optional
            if ($data['total_extrabed_price'] == NULL) {
                $item_details = array($item1_details);
            } else {
                $item_details = array($item1_details, $item2_details);
            }


            //for checking first_name last_name
            $full_name = $this->split_name($sanitizer['cust_name']);

            // Optional
            $customer_details = array(
                'first_name' => $full_name[0],
                'last_name' => $full_name[1],
                'email' => $sanitizer['cust_email'],
                'phone' => $sanitizer['cust_phone'],
                'billing_address' => '',
                'shipping_address' => '',
            );

            $enable_payments = ["credit_card", "mandiri_clickpay", "cimb_clicks",
                "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
                "bca_va", "bni_va", "other_va", "danamon_online"];

            $expiry = array(
                "start_time" => Carbon::parse(Carbon::now())->isoFormat("YYYY-MM-DD HH:mm:ss Z"),
                "unit" => "hour",
                "duration" => 1,
            );
            $bca_klikpay = array(
                "description" => "Horison ".$order_id->reservation_id
            );
            // Fill transaction details
            $transaction = array(
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
                'enabled_payments' => $enable_payments,
                "custom_field1" => "ROOMS",
                "expiry" => $expiry,
                "bca_klikpay" => $bca_klikpay,
            );

            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            Session::put('roomSnapToken', $snapToken);

            return response()->json(["status" => 200, "href" => "tab2-2", "customer_name" => $sanitizer['cust_name'], "customer_email" => $sanitizer['cust_email'], "tab" => "2", "text" => "Payment Information", "snapToken" => $snapToken]);

        } else {
            return response()->json(["status" => 422, "msg" => "Something went wrong"]);
        }
    }

    public function reserve_product(Request $request)
    {
        $input = $request->all();

        if (isset($request['forget_snap'])) {
            Session::forget('productSnapToken');
            Session::forget('product_booking_id');
            return response()->json(["status" => 200, "msg" => "Success"]);

        }
        $booking_id = $input['booking_id'];
        $validate_booking_id = Session::get('product_booking_id');

        // if (!ProductRsvp::where('booking_id', $input['booking_id'])->exists() || $booking_id != $validate_booking_id) {
        //     return response()->json(["status" => 422, "msg" => "Booking Id not found"]);
        // }

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

            // if (Session::get('productSnapToken') != null) {
            //     $snapToken = Session::get('productSnapToken');
            //     return response()->json(["status" => 200, "href" => "tab2-2", "tab" => "2", "text" => "Payment Information", "snapToken" => $snapToken]);
            // }

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

            // check product reservation_id empty or not
            $checkRsvpId = DB::table('product_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
            $valueCheckRsvpId = $checkRsvpId->reservation_id;

            if ($valueCheckRsvpId == "") {
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $sanitizer['date_reserve'], $productData->product_name, $productData->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $sanitizer['date_reserve'], $productData->product_name, $productData->sales_inquiry);
                }
            } else {
                $dataRsvpId = DB::table('product_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();
                $reservation_id = $dataRsvpId->reservation_id;
            }

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
                'reservation_id' => $reservation_id,
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

            $order_id = DB::table('product_rsvp')->select('reservation_id')->where('booking_id', $booking_id)->first();

            // Required
            $transaction_details = array(
                'order_id' => $order_id->reservation_id,
                'gross_amount' => $grandTotal, // no decimal allowed for creditcard
            );

            // Optional
            $item1_details = array(
                'id' => '1',
                'price' => $grandTotal,
                'quantity' => 1,
                'name' => $rsvp_amount_pax . " Pax " . $productData->product_name,
            );

            // Optional
            $item_details = array($item1_details);
            $full_name = $this->split_name($sanitizer['cust_name']);

            // Optional
            $customer_details = array(
                'first_name' => $full_name[0],
                'last_name' => $full_name[1],
                'email' => $sanitizer['cust_email'],
                'phone' => $sanitizer['cust_phone'],
                'billing_address' => '',
                'shipping_address' => '',
            );

            $enable_payments = ["credit_card", "mandiri_clickpay", "cimb_clicks",
                "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
                "bca_va", "bni_va", "other_va", "danamon_online"];

            $expiry = array(
                "start_time" => Carbon::parse(Carbon::now())->isoFormat("YYYY-MM-DD HH:mm:ss Z"),
                "unit" => "hour",
                "duration" => 1,
            );

            // Fill transaction details
            $transaction = array(
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
                'enabled_payments' => $enable_payments,
                "custom_field1" => "PRODUCTS",
                "expiry" => $expiry,

            );

            $snapToken = \Midtrans\Snap::getSnapToken($transaction);

            Session::put('productSnapToken', $snapToken);

            return response()->json(["status" => 200, "href" => "tab2-2", "customer_name" => $sanitizer['cust_name'], "customer_email" => $sanitizer['cust_email'], "tab" => "2", "text" => "Payment Information", "snapToken" => $snapToken]);

        } elseif ($data['type'] == "credit" || $data['type'] == "bank") {

            return response()->json(["status" => 200, "msg" => $data['type'], "transaction" => $transaction]);

        }
    }

    // uses regex that accepts any word character or hyphen in last name
    public function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

    public function faspay()
    {
        $merchant_id		= 50006;
		$merchant_user		= "bot".$merchant_id;

		$merchant_name		= "Test"; // akan di provide oleh faspay per merchant
		$merchant_password 	= "9JmwOu2R";
		//$klikpay_code		= "UATYUK";
		//$clear_key			= "KlikPayYukTraDev";
		//$server				= "Development";

		$bill_no	= date('YmdGis');
		//$bill_total	= 1450000;

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

        $bill_total = 5000000;
		// foreach($products as $rprod => $fprod){
        //     $bill_total	+= ($fprod["amount"] * $fprod["qty"]);
        // }
		//foreach($products as $rprod => $fprod){ $bill_total += ($fprod["amount"] * $fprod["qty"]); }
        //$data = serialize($products);
		// $signature	=sha1(md5(($merchant_user.$merchant_password.$bill_no.$bill_total)));
		$signature	= $this->generateSignature($merchant_user,$merchant_password,$bill_no,$bill_total);
		// dd($signature, $bill_total);

		$data = serialize($products);
		$encoded = htmlentities($data);

		$post = array(
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
			//"user_id"					=> 'tes_auto',
			//assword"					=> 'abcde',
			//"klik_pay_code"				=> $klikpay_code,
			//"clear_key"					=> $clear_key,
			//"server"					=> $server,
			//"mixed"						=> 'False',
			//id_full"					=> 'tes_auto',
			//"mid_tiga_bulan"			=> '100003',
			//"mid_enam_bulan"			=> '100006',
			//"mid_duabelas_bulan"		=> '100012',
			//"mid_duaempat_bulan"		=> '100024',
			//"cicilan_tiga_bulan"		=> 'True',
			//"cicilan_enam_bulan"		=> 'True',
		//	"cicilan_duabelas_bulan"	=> 'True',
	    //	"cicilan_duaempat_bulan"	=> 'True',
			"products"					=> $encoded,
			"return_url"            => 'https://google.com',

			"term_condition"			=> 1,
			"signature"					=> $signature,

			);
			$string = '<form method="post" name="form" action="https://dev.faspay.co.id/xpress/payment"><br>';

		//$string = '<form method="post" name="form" action="https://xpress.faspay.co.id/v3/payment"><br>';
		// $string = '<form method="post" name="form" action="https://xpress-uat.faspay.co.id/payment"><br>';
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

    public function generateSignature($merchant_user,$merchant_password,$bill_no,$bill_total)
    {
        return sha1(md5($merchant_user.$merchant_password.$bill_no.$bill_total));
    }
}
