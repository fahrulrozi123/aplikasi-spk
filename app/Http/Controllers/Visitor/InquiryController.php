<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\FunctionRoom\FunctionRoom;
use App\Models\Customer\Customer;
use App\Models\Inquiry\Inquiry;
use App\Models\Inquiry\OtherRequest;
use App\Models\Setting\Setting;
use App\Models\Admin\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use \Waavi\Sanitizer\Sanitizer;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationEmail;
use App\Mail\CustomerEmail;

class InquiryController extends Controller
{
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
}
