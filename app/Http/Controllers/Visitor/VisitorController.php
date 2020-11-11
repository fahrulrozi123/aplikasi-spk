<?php

namespace App\Http\Controllers\Visitor;

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

use Illuminate\Http\Request;
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

class VisitorController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = $this->setting();
        $banners = Banner::orderBy('banner_status', 'ASC')->get();
        $newss = News::where('news_publish_date', '<=', Carbon::now())->where('news_publish_status', "1")->orderBy('news_sticky_state', 'DESC')->orderBy('news_publish_date', 'DESC')->get();
        foreach ($newss as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }

        $spas = PageSetting::where('page_code', "Spa")->with('photo')->get();
        $functionrooms = PageSetting::where('page_code', "Function")->with('photo')->get();
        $mices = PageSetting::where('page_code', "Mice")->with('photo')->get();
        $recreations = PageSetting::where('page_code', "Recreation")->with('photo')->get();

        // dd($spas);

        return view('visitor_site.landing_page.index', get_defined_vars());
    }

    public function rooms()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $setting = $this->setting();
        $rooms = Type::orderBy('id', 'DESC')->with('amenities')->with('photo')->get();
        return view('visitor_site.rooms.index', get_defined_vars());
    }

    public function get_product()
    {
        $products = Product::select(DB::raw('DISTINCT category'))->orderBy('category')->get();

        foreach ($products as $key => $value) {
            $value['product'] = [];
            $temp = Product::select('id', 'product_name', 'sales_inquiry')->where('category', $value->category)->where('sales_inquiry', '0')->orderBy('product_name')->get()->toArray();
            $value['product'] = $temp;
        }

        return $products;

    }

    public function product_reservation(Request $request)
    {
        Session::forget('productSnapToken');
        $id = $request['product_list'];
        $date = $request['date_product'];
        $date = Carbon::parse($date)->format('d F Y');
        $data = array(
            'product_id' => $id,
            'date_reserve' => $date,
        );

        $validator = Validator::make($data, [
            'product_id' => 'required|exists:product,id',
            'date_reserve' => 'required|after_or_equal:today',
        ],
            [
                'id.required' => 'Product is required !',
                'id.exists' => 'Product not found !',
                'date_reserve.required' => 'Date is required !',
                'date_reserve.after_or_equal' => 'Sorry Date Reserve cannot less than today ',
            ]);

        if ($validator->fails()) {
            return redirect()->route('index')->with('warning', $validator->messages()->first());
        }

        $product = Product::where('id', $id)->first();

        if (Session::get('product_booking_id') != null && ProductRsvp::where('reservation_id', 'NULL')->where('booking_id', Session::get('product_booking_id'))->exists()) {
            $booking_id = Session::get('product_booking_id');
            $data = $this->input_product($booking_id, $product, $date);

        } else {
            Session::forget('product_booking_id');
            $data = $this->input_product(false, $product, $date);
            Session::put('product_booking_id', $data->booking_id);
        }
        if (!$data) {
            return redirect()->route('index');
        }

        $setting = $this->setting();
        return view('visitor_site.reserve.index', get_defined_vars());

    }

    public function input_product($booking_id, $product, $date)
    {
        $create_at = Carbon::now();
        $expired_at = Carbon::now()->addMinutes(20);

        if (!$booking_id) {
            $bytes = openssl_random_pseudo_bytes(8, $cstrong);
            $hex = bin2hex($bytes);
            $booking_id = $hex;
            while (ProductRsvp::where('booking_id', $booking_id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(8, $cstrong);
                $hex = bin2hex($bytes);
                $booking_id = $hex;
            }
            ProductRsvp::create([
                'booking_id' => $booking_id,
                'product_id' => $product->id,
                'rsvp_status' => "Waiting for payment",
                'create_at' => $create_at,
                'expired_at' => $expired_at,

            ]);
        } else {
            ProductRsvp::where('booking_id', $booking_id)->update([
                'product_id' => $product->id,
                'rsvp_status' => "Waiting for payment",
                'create_at' => $create_at,
                'expired_at' => $expired_at,
            ]);
        }
        $data = (object) array(
            'type' => 'Product',
            'reserveDate' => $date,
            'booking_id' => $booking_id,
            'productId' => $product->id,
            'productName' => $product->product_name,
            'productPrice' => $product->product_price,
            'roomName' => "",
            'totalRooms' => 0,
            'totalDays' => 0,
            'roomPrice' => 0,
            'extrabedTotal' => 0,
            'extrabedPrice' => 0,
            'totalPrice' => 0,
            'create_at' => $create_at,
            'expired_at' => $expired_at,
        );
        return $data;
    }

    public function room_reservation(Request $request)
    {
        // dd($request->all());
        Session::forget('roomSnapToken');

        $data = $request['reserve_data'];
        $data = json_decode($data);

        if (!isset($data->childAge)) {
            return redirect()->route('index');
        }

        $data->childAge = explode(',', $data->childAge);
        $cek = $this->availableDate($data->checkIn, $data->totalDays, $data->totalRooms, $data->room);

        if (!$cek) {
            return redirect()->route('index');
        }

        if (Session::get('room_booking_id') != null && RoomRsvp::where('reservation_id', 'NULL')->where('booking_id', Session::get('room_booking_id'))->exists()) {
            $booking_id = Session::get('room_booking_id');
            $data = $this->input_rsvp($booking_id, $data);

        } else {
            Session::forget('room_booking_id');
            $data = $this->input_rsvp(false, $data);
            Session::put('room_booking_id', $data->booking_id);
        }
        if (!$data) {
            return redirect()->route('index');
        }

        $setting = $this->setting();
        return view('visitor_site.reserve.index', get_defined_vars());

    }

    public function input_rsvp($id, $request)
    {
        $nowDate = Carbon::now();
        if (!isset($request->totalDays) || !isset($request->totalRooms) || !isset($request->totalExtrabed) || !isset($request->type)
            || !isset($request->adultTotal) || !isset($request->childTotal)) {
            return false;
        }
        $totalDays = $request->totalDays;
        $totalRooms = $request->totalRooms;
        $totalExtrabed = $request->totalExtrabed;
        $breakfast = $request->type;

        $adultTotal = $request->adultTotal;
        $childTotal = $request->childTotal;

        $roomId = $request->room;
        $getRoom = Type::where('id', $roomId)->first();
        $checkIn = $request->checkIn;
        $checkOut = Carbon::parse($checkIn)->addDays($totalDays);
        $checkIn = Carbon::parse($checkIn)->format('Y-m-d');
        $checkOut = Carbon::parse($checkOut)->format('Y-m-d');
        $query = "select allotment_publish_rate , allotment_ro_rate, allotment_extrabed_rate from allotment where room_id = '" . $roomId . "' and allotment_date >= '" . $checkIn . "' and allotment_date < '" . $checkOut . "' order by allotment_date";
        $rateSum = DB::select(DB::raw($query));
        $rateSum = array_map(function ($value) {
            return (array) $value;
        }, $rateSum);

        if (!$id) {
            $bytes = openssl_random_pseudo_bytes(8, $cstrong);
            $hex = bin2hex($bytes);
            $booking_id = $hex;
            while (RoomRsvp::where('booking_id', $booking_id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(8, $cstrong);
                $hex = bin2hex($bytes);
                $booking_id = $hex;
            }
        } else {
            $rsvp_data = RoomRsvp::where('booking_id', $id)->orderBy('rsvp_date_reserve', 'ASC')->get();
            $booking_id = $id;
        }

        $allRoomAmount = 0;
        $allExtrabedAmount = 0;
        $allGrandTotal = 0;
        $data = array();
        $create_at = Carbon::now();
        $expired_at = Carbon::now()->addMinutes(20);
        for ($j = 0; $j < ($totalDays); $j++) {
            $rsvpDateReserve = Carbon::parse($checkIn)->addDays($j)->format('Y-m-d');
            if ($breakfast == 0) {
                $rsvpBreakfast = 0;
                $rsvpPublishRate = $rateSum[$j]['allotment_ro_rate'];
            } else if ($breakfast == 1) {
                $rsvpBreakfast = 1;
                $rsvpPublishRate = $rateSum[$j]['allotment_publish_rate'];
            }

            $extrabedRate = $rateSum[$j]['allotment_extrabed_rate'];
            $totalExtrabedRate = $totalExtrabed * $extrabedRate;
            $totalAmountRoom = $rsvpPublishRate * $totalRooms;
            $totalAmountExtrabed = $totalExtrabedRate;

            $serviceRoom = floor($totalAmountRoom * 0.1);
            $serviceBed = floor($totalAmountExtrabed * 0.1);
            $taxRoom = floor(($totalAmountRoom + $serviceRoom) * 0.1);
            $taxBed = floor(($totalAmountExtrabed + $serviceBed) * 0.1);
            $rsvpTax = $taxRoom + $taxBed;
            $rsvpService = $serviceBed + $serviceRoom;

            $totalAmountRoom -= $serviceRoom + $taxRoom;
            $totalAmountExtrabed -= $serviceBed + $taxBed;
            $rsvpPublishRate = $totalAmountRoom / $totalRooms;
            if ($totalExtrabed > 0) {
                $extrabedRate = $totalAmountExtrabed / $totalExtrabed;
            }

            $grandTotal = $totalAmountRoom + $totalAmountExtrabed + $rsvpTax + $rsvpService;
            $allGrandTotal += $grandTotal;

            $allRoomAmount += $totalAmountRoom + $serviceRoom + $taxRoom;
            $allExtrabedAmount += $totalAmountExtrabed + $serviceBed + $taxBed;

            $temp = (object) array(
                // 'reservation_id' => "",
                'booking_id' => $booking_id,
                // 'customer_id' => '',
                'room_id' => $roomId,
                'rsvp_date_reserve' => $rsvpDateReserve,
                'rsvp_adult' => $adultTotal,
                'rsvp_child' => $childTotal,
                'rsvp_breakfast' => $rsvpBreakfast,
                'rsvp_publish_rate' => $rsvpPublishRate,
                'rsvp_extrabed_rate' => $extrabedRate,
                'rsvp_total_extrabed' => $totalExtrabed,
                'rsvp_total_room' => $totalRooms,
                'rsvp_total_amount_room' => $totalAmountRoom,
                'rsvp_total_amount_extrabed' => $totalAmountExtrabed,
                'rsvp_tax' => $rsvpTax,
                'rsvp_service' => $rsvpService,
                'rsvp_tax_total' => ($rsvpTax + $rsvpService),
                // 'rsvp_payment' => '',
                // 'rsvp_payment_card_number' => '',
                // 'rsvp_unique' => '',
                'rsvp_grand_total' => $grandTotal,
                'rsvp_status' => 'Waiting for payment',
                'create_at' => $create_at,
                'expired_at' => $expired_at,
            );
            array_push($data, $temp);

        }
        $data = array_map(function ($value) {
            return (array) $value;
        }, $data);

        if (!$id) {
            RoomRsvp::insert($data);
        } else {
            if (count($rsvp_data) > count($data)) {
                for ($i = 0; $i < count($rsvp_data); $i++) {
                    $element_rsvp = $rsvp_data[$i];
                    if (!isset($data[$i])) {
                        RoomRsvp::where('booking_id', $booking_id)->where('rsvp_date_reserve', $element_rsvp->rsvp_date_reserve)->delete();
                    } else {
                        $element_data = $data[$i];
                        RoomRsvp::where('booking_id', $booking_id)->where('rsvp_date_reserve', $element_rsvp->rsvp_date_reserve)->update([
                            'booking_id' => $booking_id,
                            'room_id' => $element_data->room_id,
                            'rsvp_date_reserve' => $element_data->rsvp_date_reserve,
                            'rsvp_adult' => $element_data->rsvp_adult,
                            'rsvp_child' => $element_data->rsvp_child,
                            'rsvp_breakfast' => $element_data->rsvp_breakfast,
                            'rsvp_publish_rate' => $element_data->rsvp_publish_rate,
                            'rsvp_extrabed_rate' => $element_data->rsvp_extrabed_rate,
                            'rsvp_total_extrabed' => $element_data->rsvp_total_extrabed,
                            'rsvp_total_room' => $element_data->rsvp_total_room,
                            'rsvp_total_amount_room' => $element_data->rsvp_total_amount_room,
                            'rsvp_total_amount_extrabed' => $element_data->rsvp_total_amount_extrabed,
                            'rsvp_tax' => $element_data->rsvp_tax,
                            'rsvp_service' => $element_data->rsvp_service,
                            'rsvp_tax_total' => $element_data->rsvp_tax_total,
                            'rsvp_grand_total' => $element_data->room_id,
                            'rsvp_status' => 'Waiting for payment',
                            'create_at' => $element_data->create_at,
                            'expired_at' => $element_data->expired_at,
                        ]);
                    }
                }
            } else {
                for ($i = 0; $i < count($data); $i++) {
                    $element_data = $data[$i];

                    if (!isset($rsvp_data[$i])) {
                        RoomRsvp::insert($element_data);
                    } else {
                        $element_data = (object) $element_data;
                        $element_rsvp = $rsvp_data[$i];
                        RoomRsvp::where('booking_id', $booking_id)->where('rsvp_date_reserve', $element_rsvp->rsvp_date_reserve)->update([
                            'booking_id' => $booking_id,
                            'room_id' => $element_data->room_id,
                            'rsvp_date_reserve' => $element_data->rsvp_date_reserve,
                            'rsvp_adult' => $element_data->rsvp_adult,
                            'rsvp_child' => $element_data->rsvp_child,
                            'rsvp_breakfast' => $element_data->rsvp_breakfast,
                            'rsvp_publish_rate' => $element_data->rsvp_publish_rate,
                            'rsvp_extrabed_rate' => $element_data->rsvp_extrabed_rate,
                            'rsvp_total_extrabed' => $element_data->rsvp_total_extrabed,
                            'rsvp_total_room' => $element_data->rsvp_total_room,
                            'rsvp_total_amount_room' => $element_data->rsvp_total_amount_room,
                            'rsvp_total_amount_extrabed' => $element_data->rsvp_total_amount_extrabed,
                            'rsvp_tax' => $element_data->rsvp_tax,
                            'rsvp_service' => $element_data->rsvp_service,
                            'rsvp_tax_total' => $element_data->rsvp_tax_total,
                            'rsvp_grand_total' => $element_data->room_id,
                            'rsvp_status' => 'Waiting for payment',
                            'create_at' => $element_data->create_at,
                            'expired_at' => $element_data->expired_at,
                        ]);
                    }
                }
            }
        }
        $roomNameDetails = $totalRooms . " x " . $getRoom->room_name;
        if ($breakfast == 1) {
            $roomNameDetails .= " (Room with Breakfast)";
        }
        $checkIn = Carbon::parse($checkIn)->format('d F Y');
        $checkOut = Carbon::parse($checkOut)->format('d F Y');
        $reserveDate = $checkIn . " - " . $checkOut;
        $totalGuest = $adultTotal . " Adult";
        if ($childTotal > 0) {
            $totalGuest .= " & " . $childTotal . " Child";
        }
        $roomDetail = $totalRooms . " Rooms x " . $totalDays . " Nights";
        $roomPrice = (integer) $allRoomAmount;

        $extrabedTotal = (integer) $totalExtrabed;
        $extrabedPrice = (integer) $allExtrabedAmount;

        $totalPrice = (integer) $allGrandTotal;

        $data = (object) array(
            "productPrice" => "0",
            "productName" => "",
            "productId" => "0",
            "booking_id" => $booking_id,
            "type" => "Room",
            "roomName" => $getRoom->room_name,
            "totalRooms" => $totalRooms,
            "totalDays" => $totalDays,
            "roomNameDetails" => $roomNameDetails,
            "reserveDate" => $reserveDate,
            "totalGuest" => $totalGuest,
            "roomDetail" => $roomDetail,
            "roomPrice" => $roomPrice,
            "extrabedTotal" => $extrabedTotal,
            "extrabedPrice" => $extrabedPrice,
            "totalPrice" => $totalPrice,
            'create_at' => $create_at,
            'expired_at' => $expired_at);

        Session::put('room_booking_id', $booking_id);
        return $data;
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

    public function recreation()
    {
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $recreations = Product::where('category', '1')->orderBy('id', 'DESC')->with('photos')->get();
        return view('visitor_site.recreation.index', get_defined_vars());
    }

    public function allysea_spa()
    {
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $spas = Product::where('category', '2')->orderBy('id', 'DESC')->with('photos')->get();
        return view('visitor_site.allysea_spa.index', get_defined_vars());

    }

    public function mice_wedding()
    {
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $mices = Product::where('category', '3')->orWhere('category', '4')->orderBy('category')->orderBy('id', 'DESC')->with('photos')->get();
        return view('visitor_site.mice_wedding.index', get_defined_vars());
    }

    public function function_room()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $function_rooms = FunctionRoom::with('partition')->with('photos')->where('func_head', null)->orderBy('func_name')->get();
        $mices = Product::where('category', '3')->orWhere('category', '4')->orderBy('category')->orderBy('category', 'DESC')->with('photos')->get();

        // dd($function_rooms);
        return view('visitor_site.function_room.index', get_defined_vars());
    }

    public function details()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $setting = $this->setting();
        $id = Input::get('key', null);
        $from = Input::get('from', null);

        $photos = array();

        if ($from == "rooms") {
            if (!Type::where('id', $id)->with('photo')->exists()) {
                return redirect()->back();
            }
            $room = Type::where('id', $id)->with('photo')->first();
            $data = (object) array("name" => $room->room_name, "detail" => $room->room_desc);
            foreach ($room['photo'] as $key => $value) {
                $temp = (object) array(
                    'photo_path' => $value->photo_path,
                );
                array_push($photos, $temp);
            }
        } else if ($from == "recreation" || $from == "allysea_spa" || $from == "mice_wedding" || $from == "mice_wedding") {
            if (!Product::where('id', $id)->with('photos')->exists()) {
                return redirect()->back();
            }
            $product = Product::where('id', $id)->with('photos')->first();
            $data = (object) array("name" => $product->product_name, "detail" => $product->product_detail);
            foreach ($product['photos'] as $key => $value) {
                $temp = (object) array(
                    'photo_path' => $value->product_photo_path,
                );
                array_push($photos, $temp);
            }
        } else if ($from == "function_roomA" || $from == "function_roomB") {
            if ($from == "function_roomA") {
                if (!FunctionRoom::where('id', $id)->with('photos')->where('func_head', null)->exists()) {
                    return redirect()->back();
                }
                $function = FunctionRoom::where('id', $id)->with('partition')->with('photos')->where('func_head', null)->first();
                $data = (object) array("name" => $function->func_name, "detail" => $function->func_room_desc, "function" => $function);
                foreach ($function['photos'] as $key => $value) {
                    $temp = (object) array(
                        'photo_path' => $value->photo_path,
                    );
                    array_push($photos, $temp);
                }
            } else if ($from == "function_roomB") {
                if (!Product::where('id', $id)->with('photos')->exists()) {
                    return redirect()->back();
                }
                $product = Product::where('id', $id)->with('photos')->first();
                $data = (object) array("name" => $product->product_name, "detail" => $product->product_detail);
                foreach ($product['photos'] as $key => $value) {
                    $temp = (object) array(
                        'photo_path' => $value->product_photo_path,
                    );
                    array_push($photos, $temp);
                }
            }
            $from = "function_room";

        } else {
            return redirect()->back();
        }
        return view('visitor_site.details', get_defined_vars());
    }

    public function newsletter()
    {
        $setting = $this->setting();
        $newss = News::where('news_publish_date', '<=', Carbon::now())->where('news_publish_status', "1")->orderBy('news_sticky_state', 'DESC')->orderBy('news_publish_date', 'DESC')->paginate(8);
        foreach ($newss as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }
        return view('visitor_site.newsletter.index', get_defined_vars());

    }

    public function reservation()
    {
        // $id = Crypt::decryptString(['id']);

        $room_available = [];
        $totalDays = Input::get('stay_total', null);
        $totalRoom = Input::get('room_total', null);
        $totalExtrabed = Input::get('extra_bed', null);
        $adultTotal = Input::get('adult_total', null);
        $childTotal = Input::get('child_total', null);
        $childAge = Input::get('child_age', null);
        $checkIn = Carbon::parse(Input::get('checkin', null))->format('Y-m-d');
        $checkOut = Carbon::parse($checkIn)->addDays($totalDays);
        $today = Carbon::now();
        $today = Carbon::parse($today)->format('Y-m-d');

        $totalGuest = $adultTotal + $childTotal;

        if ($checkIn < $today) {
            return redirect()->route('index');
        }
        if ($childTotal > 0) {
            $childTemp = explode(',', $childAge);
            if (count($childTemp) != $childTotal) {
                return redirect()->route('index');
            }
            foreach ($childTemp as $key => $value) {
                if ($value == "" || $value > 10) {
                    return redirect()->route('index');
                } else {
                    $childTemp[$key] = (int) $value;
                }
            }
        } else {
            if ($childAge != null) {
                return redirect()->route('index');
            }
            $childTemp = (array) null;
        }

        if ($checkIn == null || $totalDays == null || $totalRoom == null || $totalExtrabed == null || $adultTotal == null || $childTotal == null) {

            return redirect()->route('index');
        }

        $adult_child_total = $adultTotal + $childTotal;
        $max_adult_child = $totalRoom * 5 + $totalExtrabed;
        $need_extrabed = $totalRoom * 2 + 1;

        //validation adult
        $max_adult = $totalRoom * 2 + $totalRoom;
        $min_adult = $totalRoom;

        //validation child
        $min_child = 0;
        $max_child = $totalRoom * 2;

        //validation Extrabed
        $min_extrabed = floor($adultTotal / ($totalRoom + 1));
        $max_extrabed = $totalRoom;
        $max_child = $totalRoom;

        if ($totalRoom > 5) {

            return redirect()->route('index');
        }
        if ($totalExtrabed > $max_extrabed) {

            return redirect()->route('index');
        }
        if ($adultTotal < $min_adult || $adultTotal > $max_adult) {

            return redirect()->route('index');
        }
        if ($adultTotal == $need_extrabed && $totalExtrabed < $min_extrabed) {

            return redirect()->route('index');
        }
        if ($adult_child_total > $max_adult_child) {

            return redirect()->route('index');
        }

        if ($totalExtrabed == 0) {
            $rooms = Type::with('bed')->with('allotment')->with('amenities')->with('photo')->get();
        } else {
            $rooms = Type::where('room_extrabed_rate', '<>', 0)->with('bed')->with('allotment')->with('amenities')->with('photo')->get();
        }
        foreach ($rooms as $key => $value) {
            $cek = $this->availableDate($checkIn, $totalDays, $totalRoom, $value->id);

            if ($cek) {
                $room = Type::with('bed')->with('amenities')->with('photo')->with(['allotment' => function ($q) use ($checkIn) {
                    // Query the name field in status table
                    $q->where('allotment.allotment_date', '=', $checkIn); // '=' is optional
                }])
                    ->where('id', $value->id)
                    ->first();
                array_push($room_available, $room);
            }
        }

        $checkIn = Carbon::parse($checkIn)->format('d F Y');
        $checkOut = Carbon::parse($checkOut)->format('d F Y');

        // $tags = json_decode(file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn=' . $this->getIP()), true);

        // if ($tags['geobyteslocationcode'] != '') {

        //     $thisCurrency = $tags['geobytescurrencycode'];
        //     $rates = 0;
        //     $new_curr = "IDR";
        //     if ($thisCurrency != "IDR") {
        //         $to = $thisCurrency;
        //         $new_curr = $to;
        //         // change to the free URL if you're using the free version
        //         $curr = json_decode(file_get_contents("https://free.currconv.com/api/v7/convert?q=IDR_" . $to . "&compact=ultra&apiKey=b53b3e01c91301ad3314"), true);
        //         $index = "IDR_" . $to;
        //         $rates = $curr[$index];

        //     }
        //     foreach ($room_available as $key => $value) {
        //         $element = $value['allotment'][0];
        //         $total = $element->allotment_publish_rate * $rates;
        //         $total = number_format($total, 2, '.', '');
        //         $element['new_curr'] = $new_curr;
        //         $element['new_price'] = $total;
        //         // dd($total);
        //     }
        // }

        $setting = $this->setting();
        return view('visitor_site.reservation.index', get_defined_vars());
    }

    public function getIP()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function convertCurrency($amount, $from_currency, $to_currency)
    {
        $apikey = 'b53b3e01c91301ad3314';

        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query = "{$from_Currency}_{$to_Currency}";

        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);

        $val = floatval($obj["$query"]);

        $total = $val * $amount;
        return number_format($total, 2, '.', '');
    }

    public function not_avail()
    {
        return view('visitor_site.reservation.not_avail', get_defined_vars());

    }

    public function custinfo()
    {
        return view('visitor_site.cust_info.index', get_defined_vars());

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

    public function inquiry()
    {
        $from = Input::get('from', null);
        if ($from != null) {
            if ($from != "recreational" && $from != "spa" && $from != "mice" && $from != "wedding") {
                $from = null;
            }
        }
        $recreations = Product::select('id', 'product_name')->where('category', '1')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $spas = Product::select('id', 'product_name')->where('category', '2')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $mices = Product::select('id', 'product_name')->where('category', '3')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $weddings = Product::select('id', 'product_name')->where('category', '4')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $function_rooms = FunctionRoom::orderBy('func_name')->get();

        $setting = $this->setting();
        return view('visitor_site.inquiry.index', get_defined_vars());
    }

    public function inquiry_insert(Request $request)
    {

        $other_request = ['1', '2', '3', '4', '5'];
        $mice_other_request = ['1', '2', '3', '4', '5', '6'];
        $wedding_other_request = ['7', '8', '9',
        '10', '11', '12', '13', '14', '15', '16', '17', '18'];

        //cheatsheet for filter

        // $filters = [
        //     'full_name'    =>  'trim|escape|capitalize',
        //     'last_name'     =>  'trim|escape|capitalize',
        //     'email'         =>  'trim|escape|lowercase',
        //     'birthdate'     =>  'trim|format_date:m/d/Y, Y-m-d',
        //     'jsonVar'       =>  'cast:array',
        //     'description'   =>  'strip_tags',
        //     'phone'         =>  'digit',
        //     'country'       =>  'trim|escape|capitalize',
        //     'postcode'      =>  'trim|escape|uppercase|filter_if:country,GB',
        // ];

        //end cheatsheet
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:50',
            // 'email' => 'required|email|unique:customer,cust_email',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
        }

        $filters = [
            'full_name' => 'trim|escape|capitalize',
            'email' => 'trim|escape|lowercase',
            'phone_number' => 'digit',
        ];

        $data = $request->all();
        $sanitizer = new Sanitizer($data, $filters);
        $sanitizer = $sanitizer->sanitize();

        $cust_email = $sanitizer['email'];
        $cust_name = $sanitizer['full_name'];
        $cust_phone = $sanitizer['phone_number'];

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

        if (isset($request['btn_general'])) {
            $validator = Validator::make($request->all(), [
                'btn_general' => 'required|numeric|min:0|max:0',
                // 'email' => 'required|email|unique:customer,cust_email',
                'general_details' => 'required',
            ],[
                'general_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {
                $filters = [
                    'general_details' => 'strip_tags',
                ];

                $data = $request->all();
                $sanitizer = new Sanitizer($data, $filters);
                $sanitizer = $sanitizer->sanitize();
                // dd($sanitizer);
                $date = Carbon::now();

                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date, "General Inquiry", 1);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date, "General Inquiry", 1);
                }

                $create_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'inq_event_start' => Carbon::now(),
                    'inq_type' => $sanitizer['btn_general'],
                    'inq_details' => $sanitizer['general_details'],
                    'create_at' => $create_at
                ];

                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');

            }
        } else if (isset($request['btn_rec'])) {

            $validator = Validator::make($request->all(), [
                'btn_rec' => 'required|numeric|min:1|max:1',
                'rec_product' => 'required|exists:product,id',
                'rec_participant' => 'required|min:1|max:9999',
                'rec_date' => 'required|after_or_equal:today',
                'rec_details' => 'required',

            ],[
                'rec_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {
                $filters = [
                    'btn_rec' => 'digit',
                    'rec_participant' => 'digit',
                    'rec_details' => 'strip_tags',
                ];

                $data = $request->all();
                $sanitizer = new Sanitizer($data, $filters);
                $sanitizer = $sanitizer->sanitize();
                $date = $sanitizer['rec_date'];
                $date = Carbon::parse($date)->format('Y-m-d');

                $product = Product::where('id', $sanitizer['rec_product'])->first();
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);
                }

                if (isset($request['rec_other_request'])) {
                    foreach ($request['rec_other_request'] as $key => $value) {
                        if (!in_array($value, $other_request)) {
                            return redirect()->back()->withInput($request->all)->with('warning', "Sorry your other request is not found ");
                        } else {
                            OtherRequest::insert([
                                "inquiry_id" => $reservation_id,
                                "other_request_id" => $value,
                            ]);
                        }
                    }
                }

                $create_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'product_id' => $data['rec_product'],
                    'inq_type' => $sanitizer['btn_rec'],
                    'inq_participant' => $sanitizer['rec_participant'],
                    'inq_event_start' => $date,
                    'inq_event_end' => $date,
                    'inq_alt_start' => $date,
                    'inq_alt_end' => $date,
                    'inq_details' => isset($sanitizer['rec_details']) ? $sanitizer['rec_details'] : "",
                    'create_at' => $create_at
                ];
                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');

            }

        } else if (isset($request['btn_spa'])) {

            $request['spa_time'] = $request['spa_date'] . ' ' . $request['spa_time'];
            $request['spa_time'] = Carbon::parse($request['spa_time'])->isoFormat('YYYY-MM-DD HH:mm');

            $validator = Validator::make($request->all(), [
                'btn_spa' => 'required|numeric|min:2|max:2',
                'spa_product' => 'required|exists:product,id',
                'spa_participant' => 'required|min:1|max:9999',
                'spa_date' => 'required|after_or_equal:today',
                'spa_time' => 'required|date_format:Y-m-d H:i|after:1 hours',
                'spa_details' => 'required',

            ],[
                'spa_details.required' => 'Inquiry Details is required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {
                $request['spa_time'] = Carbon::parse($request['spa_time'])->isoFormat('h:mm A');

                $filters = [
                    'btn_spa' => 'digit',
                    'spa_participant' => 'digit',
                    'spa_details' => 'strip_tags',
                ];

                $data = $request->all();
                $sanitizer = new Sanitizer($data, $filters);
                $sanitizer = $sanitizer->sanitize();
                $date = $sanitizer['spa_date'];

                $date = Carbon::parse($date)->format('Y-m-d');
                $product = Product::where('id', $data['spa_product'])->first();

                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);
                }

                if (isset($request['spa_other_request'])) {
                    foreach ($request['spa_other_request'] as $key => $value) {
                        if (!in_array($value, $other_request)) {
                            return redirect()->back()->withInput($request->all)->with('warning', "Sorry your other request is not found ");
                        } else {
                            OtherRequest::insert([
                                "inquiry_id" => $reservation_id,
                                "other_request_id" => $value,
                            ]);
                        }
                    }
                }

                $create_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'product_id' => $data['spa_product'],
                    'inq_type' => $sanitizer['btn_spa'],
                    'inq_participant' => $sanitizer['spa_participant'],
                    'inq_event_start' => $date,
                    'inq_event_end' => $date,
                    'inq_alt_start' => $date,
                    'inq_alt_end' => $date,
                    'inq_arrive_time' => $data['spa_time'],
                    'inq_details' => isset($sanitizer['spa_details']) ? $sanitizer['spa_details'] : "",
                    'create_at' => $create_at
                ];

                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');

            }

        } else if (isset($request['btn_mice'])) {
            $validator = Validator::make($request->all(), [
                'btn_mice' => 'required|numeric|min:3|max:3',
                'mice_product' => 'required|exists:product,id',
                'mice_name' => 'required|string|max:50',
                'mice_participant' => 'required|min:1|max:9999',
                'mice_event_type' => 'required',
                'mice_other_values' => 'required_if:mice_event_type,in:None',
                'mice_function_room' => 'required',
                'mice_event_start' => 'required|after_or_equal:today',
                'mice_alt_start' => 'nullable|after:mice_event_start',
                'mice_details' => 'required',

            ],[
                'mice_name.required' => 'Event name is required',
                'mice_event_start.required' => 'Event name is required',
                'mice_participant.required' => 'Number of participant is required',
                'mice_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {

                if ($request['mice_function_room'] != "None") {
                    if (!FunctionRoom::where('id', $request['mice_function_room'])->exists()) {
                        return redirect()->back()->withInput($request->all)->with('warning', "Sorry your Function Room '" . $request['mice_function_room'] . "' is not found ");
                    }
                }
                // dd($request->all());
                $filters = [
                    'btn_mice' => 'digit',
                    'mice_name' => 'trim|escape|capitalize',
                    'mice_participant' => 'digit',
                    'mice_event_type' => 'trim|escape|capitalize',
                    'mice_other_values' => 'trim|escape|capitalize',
                    'mice_details' => 'strip_tags',
                ];

                $data = $request->all();
                $sanitizer = new Sanitizer($data, $filters);
                $sanitizer = $sanitizer->sanitize();
                $date_start = $sanitizer['mice_event_start'];
                $date_alt = $sanitizer['mice_alt_start'];

                $date_start = Carbon::parse($date_start)->format('Y-m-d');
                $date_alt = Carbon::parse($date_alt)->format('Y-m-d');

                if ($sanitizer['mice_event_type'] == "Others") {
                    $event_type = $sanitizer['mice_other_values'];
                } else {
                    $event_type = $sanitizer['mice_event_type'];
                }

                $product = Product::where('id', $data['mice_product'])->first();
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);
                }

                if (isset($request['mice_other_request'])) {
                    foreach ($request['mice_other_request'] as $key => $value) {
                        if (!in_array($value, $mice_other_request)) {
                            return redirect()->back()->withInput($request->all)->with('warning', "Sorry your other request '" . $value . "' is not found ");
                        } else {
                            OtherRequest::insert([
                                "inquiry_id" => $reservation_id,
                                "other_request_id" => $value,
                            ]);
                        }
                    }
                }

                $create_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'function_room_id' => $sanitizer['mice_function_room'] == "None" ? "" : $sanitizer['mice_function_room'],
                    'product_id' => $data['mice_product'],
                    'inq_type' => $sanitizer['btn_mice'],
                    'inq_event_name' => $sanitizer['mice_name'],
                    'inq_event_type' => $event_type,
                    'inq_participant' => $sanitizer['mice_participant'],
                    'inq_event_start' => $date_start,
                    'inq_event_end' => $date_start,
                    'inq_alt_start' => $date_alt,
                    'inq_alt_end' => $date_alt,
                    'inq_budget' => isset($data['mice_budget']) ? $data['mice_budget'] : 0,
                    'inq_details' => isset($sanitizer['mice_details']) ? $sanitizer['mice_details'] : "",
                    'create_at' => $create_at
                ];

                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');
            }

        } else if (isset($request['btn_wedding'])) {
            $wedding_service_request = ['Information', 'Proposal Sheet'];
            if (!in_array($request['wedding_service_request'], $wedding_service_request)) {
                return redirect()->back()->withInput($request->all)->with('warning', "Sorry your Service request '" . $request['wedding_service_request'] . "' is not found ");
            }

            $validator = Validator::make($request->all(), [
                'btn_wedding' => 'required|numeric|min:4|max:4',
                'wedding_product' => 'required|exists:product,id',
                'wedding_event_start' => 'required|after_or_equal:today',
                'wedding_alt_start' => 'nullable|after:wedding_event_start',
                'wedding_participant' => 'required|min:1|max:9999',
                'wedding_details' => 'required'
            ],[
                'wedding_event_start.required' => 'Wedding date is required',
                'wedding_participant.required' => 'Number of guest is required',
                'wedding_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            }

            $filters = [
                'btn_wedding' => 'digit',
                'mice_name' => 'trim|escape|capitalize',
                'wedding_participant' => 'digit',
                'wedding_details' => 'strip_tags',
            ];

            $data = $request->all();
            $sanitizer = new Sanitizer($data, $filters);
            $sanitizer = $sanitizer->sanitize();
            $date_start = $sanitizer['wedding_event_start'];
            $date_alt = $sanitizer['wedding_alt_start'];

            $date_start = Carbon::parse($date_start)->format('Y-m-d');
            $date_alt = Carbon::parse($date_alt)->format('Y-m-d');

            $product = Product::where('id', $data['wedding_product'])->first();

            $rsvp_id = rand($min = 1, $max = 99999);
            $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);

            while ($reservation_id == false) {
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);
            }

            if (isset($request['wedding_other_request'])) {
                foreach ($request['wedding_other_request'] as $key => $value) {
                    if (!in_array($value, $wedding_other_request)) {
                        return redirect()->back()->withInput($request->all)->with('warning', "Sorry your Other request '" . $value . "' is not found ");
                    } else {
                        OtherRequest::insert([
                            "inquiry_id" => $reservation_id,
                            "other_request_id" => $value,
                        ]);
                    }
                }
            }

            $create_at = Carbon::now();

            $inquiry = [
                'reservation_id' => $reservation_id,
                'customer_id' => $customer_id,
                'inq_cust_name' => $cust_name,
                'inq_cust_phone' => $cust_phone,
                'product_id' => $data['wedding_product'],
                'inq_type' => $sanitizer['btn_wedding'],
                'inq_event_name' => "Proposal Sheet",
                'inq_participant' => $sanitizer['wedding_participant'],
                'inq_event_start' => $date_start,
                'inq_event_end' => $date_start,
                'inq_alt_start' => $date_alt,
                'inq_alt_end' => $date_alt,
                'inq_details' => isset($sanitizer['wedding_details']) ? $sanitizer['wedding_details'] : "",
                'create_at' => $create_at
            ];

            Inquiry::insert($inquiry);
            $from = "INQUIRY";
            $rsvp_id = $inquiry['reservation_id'];
            $this->resendEmail($from, $rsvp_id);
            return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');
        }

    }

    public function news_detail($id)
    {
        $setting = $this->setting();
        $news = News::where('id', $id)->first();
        $news->news_publish_date = Carbon::parse($news->news_publish_date)->format('l d F Y');
        $other_news = News::where('id', '<>', $id)->orderBy("news_sticky_state", "DESC")->orderBy("news_publish_date", "DESC")->get();
        foreach ($other_news as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }
        return view('visitor_site.newsletter.news_detail', get_defined_vars());
    }

    public function availableDate($date, $totalDays, $totalRooms, $id)
    {
        $room_total_temp = array();
        $query = "select ";
        for ($i = 0; $i < $totalDays; $i++) {
            if ($i > 0) {
                $query .= ', ';
            }
            $nowDate = Carbon::parse($date)->addDays($i);
            $endDate = Carbon::parse($date)->addDays($totalDays);
            $nowDate = Carbon::parse($nowDate)->format('Y-m-d');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');

            $room = Type::where('room_type.id', $id)->where('allotment.allotment_date', $nowDate)->join('allotment', 'room_type.id', '=', 'allotment.room_id')->get();
            if (count($room) > 0) {
                $room_total_temp[$i] = $room[0]->allotment_room;
            } else {
                $start = Carbon::now();
                $dateDiff = Carbon::parse($nowDate);
                $dateDiff = $start->diffInMonths($dateDiff);

                $room = Type::where('id', $id)->first();

                if ($dateDiff > $room->room_future_availability) {
                    return false;
                }
                $day = Carbon::parse($nowDate)->format('l');
                if ($day == "Friday" || $day == "Saturday" || $day == "Sunday") {
                    $room_publish_rate = $room->room_weekend_rate;
                    $room_ro_rate = $room->room_weekend_ro_rate;
                } else {
                    $room_publish_rate = $room->room_publish_rate;
                    $room_ro_rate = $room->room_ro_rate;
                }

                Allotment::create([
                    'room_id' => $room->id,
                    'user_id' => "1",
                    'allotment_room' => $room->room_allotment,
                    'allotment_publish_rate' => $room_publish_rate,
                    'allotment_ro_rate' => $room_ro_rate,
                    'allotment_extrabed_rate' => $room->room_extrabed_rate,
                    'allotment_date' => $nowDate,
                ]);
                $this->availableDate($date, $totalDays, $totalRooms, $id);
            }
            $query .= '(select sum(rsvp_total_room) from room_rsvp a where a.room_id = "' . $id . '" and a.rsvp_date_reserve >= "' . $nowDate . '" and a.rsvp_date_reserve < "' . $endDate . '" and rsvp_status <> "Failed") as date_' . $i;
            if ($i == $totalDays) {
                $query .= ' LIMIT 1';
            }
        }

        $rsvp_sum = DB::select(DB::raw($query));
        $rsvp_sum = array_map(function ($value) {
            return (array) $value;
        }, $rsvp_sum)[0];
        $rsvp_sum = array_values($rsvp_sum);
        $room_total_temp = array_values($room_total_temp);

        for ($n = 0; $n < count($room_total_temp); $n++) {
            if ($rsvp_sum[$n] + $totalRooms > $room_total_temp[$n]) {
                return false;
            }
        }
        return true;

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

    // uses regex that accepts any word character or hyphen in last name
    public function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

    public function storeNotification(Request $request)
    {
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $id = Session::get('room_booking_id');
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];

        RoomRsvp::where('booking_id', $id)->update([
            'endpoint' => $endpoint,
            'public_key' => $key,
            'auth_token' => $token,
        ]);

        $this->push($id);
    }

    public function push(){

        $data = RoomRsvp::where('booking_id', "1c8488b3d796b20e")->limit(1)->get();

        Notification::send($data, new PushDemo);

        return response()->json(['success' => true],200);
    }

    public function test_email()
    {
        $this->resendEmail("ROOMS", "75601RSVRM1VII2020");
    }

    public function test_email2()
    {
        $this->resendEmail("INQUIRY", "09162INQPDGEN1VIII2020");
    }
}
