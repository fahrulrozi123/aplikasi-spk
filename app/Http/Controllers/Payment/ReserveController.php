<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Room\Type;
use App\Models\Allotment\Allotment;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Product\Product;
use App\Models\Product\Rsvp as ProductRsvp;

use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
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

    public function reservation()
    {
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

        $setting = $this->setting();
        return view('visitor_site.reservation.index', get_defined_vars());
    }

    public function paymentChannel()
    {
        $merchant          = config('faspay.merchant');
        $merchant_id	   = config('faspay.merchantId');
        $merchant_password = config('faspay.merchantPassword');
        $merchant_user	   = 'bot'.$merchant_id;
        $signature         = sha1(md5($merchant_user.$merchant_password));

        $client = new Client();

        $response = $client->post('https://dev.faspay.co.id/cvr/100001/10', [
            'json' => [
                'request'     => 'Request List of Payment Gateway',
                'merchant_id' => $merchant_id,
                'merchant'    => $merchant,
                'signature'   => $signature
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function room_reservation(Request $request)
    {
        // dd($request->all());
        // Session::forget('roomSnapToken');

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

        $paymentChannels = $this->paymentChannel();
        $listPaymentChannels = json_decode($paymentChannels, true);

        return view('visitor_site.reserve.index', get_defined_vars());

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
        // Session::forget('productSnapToken');
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

        $paymentChannels = $this->paymentChannel();
        $listPaymentChannels = json_decode($paymentChannels, true);

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

    public function custinfo()
    {
        return view('visitor_site.cust_info.index', get_defined_vars());
    }
}
