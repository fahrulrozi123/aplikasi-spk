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
use App\Models\Product\Rsvp as ProductRsvp;

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
            if ($from != "recreational" && $from != "wellness" && $from != "mice" && $from != "promotion") {
                $from = null;
            }
        }
        $recreations = Product::select('id', 'product_name')->where('category', '1')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $wellnesses = Product::select('id', 'product_name')->where('category', '2')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $mices = Product::select('id', 'product_name')->where('category', '3')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $promotions = Product::select('id', 'product_name')->where('category', '4')->where('sales_inquiry', '1')->orderBy('product_name')->get();
        $function_rooms = FunctionRoom::orderBy('func_name')->get();

        $menu = $this->menu();
        $setting = $this->setting();
        return view('visitor_site.inquiry.index', get_defined_vars());
    }

    public function inquiry_insert(Request $request)
    {
        $other_request = ['1', '2', '3', '4', '5'];
        $mice_other_request = ['1', '2', '3', '4', '5', '6'];
        $promotion_other_request = ['7', '8', '9',
        '10', '11', '12', '13', '14', '15', '16', '17', '18'];

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

                $created_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'inq_event_start' => Carbon::now(),
                    'inq_type' => $sanitizer['btn_general'],
                    'inq_details' => $sanitizer['general_details'],
                    'created_at' => $created_at
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
                'rec_time' => 'required',
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

                $created_at = Carbon::now();

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
                    'created_at' => $created_at
                ];
                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');

            }

        } else if (isset($request['btn_wellness'])) {

            $request['wellness_time'] = $request['wellness_date'] . ' ' . $request['wellness_time'];
            $request['wellness_time'] = Carbon::parse($request['wellness_time'])->isoFormat('YYYY-MM-DD HH:mm');

            $validator = Validator::make($request->all(), [
                'btn_wellness' => 'required|numeric|min:2|max:2',
                'wellness_product' => 'required|exists:product,id',
                'wellness_participant' => 'required|min:1|max:9999',
                'wellness_date' => 'required|after_or_equal:today',
                'wellness_time' => 'required',
                'wellness_details' => 'required',

            ],[
                'wellness_details.required' => 'Inquiry Details is required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {
                $request['wellness_time'] = Carbon::parse($request['wellness_time'])->isoFormat('h:mm A');

                $filters = [
                    'btn_wellness' => 'digit',
                    'wellness_participant' => 'digit',
                    'wellness_details' => 'strip_tags',
                ];

                $data = $request->all();
                $sanitizer = new Sanitizer($data, $filters);
                $sanitizer = $sanitizer->sanitize();
                $date = $sanitizer['wellness_date'];
                $date = Carbon::parse($date)->format('Y-m-d');
                $product = Product::where('id', $data['wellness_product'])->first();

                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);
                }

                $created_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'product_id' => $data['wellness_product'],
                    'inq_type' => $sanitizer['btn_wellness'],
                    'inq_participant' => $sanitizer['wellness_participant'],
                    'inq_event_start' => $date,
                    'inq_event_end' => $date,
                    'inq_alt_start' => $date,
                    'inq_alt_end' => $date,
                    'inq_arrive_time' => $data['wellness_time'],
                    'inq_details' => isset($sanitizer['wellness_details']) ? $sanitizer['wellness_details'] : "",
                    'created_at' => $created_at
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
                'mice_participant' => 'required|min:1|max:9999',
                'mice_date' => 'required|after_or_equal:today',
                'mice_time' => 'required',
                'mice_details' => 'required',

            ],[
                'mice_name.required' => 'Event name is required',
                'mice_date.required' => 'Event date is required',
                'mice_participant.required' => 'Number of participant is required',
                'mice_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            } else {

                $request['mice_time'] = Carbon::parse($request['mice_time'])->isoFormat('h:mm A');
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
                $date_start = $sanitizer['mice_date'];
                $date_start = Carbon::parse($date_start)->format('Y-m-d');

                $product = Product::where('id', $data['mice_product'])->first();
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);

                while ($reservation_id == false) {
                    $rsvp_id = rand($min = 1, $max = 99999);
                    $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);
                }

                $created_at = Carbon::now();

                $inquiry = [
                    'reservation_id' => $reservation_id,
                    'customer_id' => $customer_id,
                    'inq_cust_name' => $cust_name,
                    'inq_cust_phone' => $cust_phone,
                    'product_id' => $data['mice_product'],
                    'inq_type' => $sanitizer['btn_mice'],
                    'inq_participant' => $sanitizer['mice_participant'],
                    'inq_event_start' => $date_start,
                    'inq_event_end' => $date_start,
                    'inq_arrive_time' => $data['mice_time'],
                    'inq_details' => isset($sanitizer['mice_details']) ? $sanitizer['mice_details'] : "",
                    'created_at' => $created_at
                ];

                Inquiry::insert($inquiry);
                $from = "INQUIRY";
                $rsvp_id = $inquiry['reservation_id'];
                $this->resendEmail($from, $rsvp_id);
                return redirect()->route('inquiry.index')->with('status', 'Your inquiry have been submitted');
            }

        } else if (isset($request['btn_promotion'])) {
            $promotion_service_request = ['Information', 'Proposal Sheet'];

            $validator = Validator::make($request->all(), [
                'btn_promotion' => 'required|numeric|min:4|max:4',
                'promotion_product' => 'required|exists:product,id',
                'promotion_date' => 'required|after_or_equal:today',
                'promotion_time' => 'required',
                'promotion_participant' => 'required|min:1|max:9999',
                'promotion_details' => 'required'
            ],[
                'promotion_date.required' => 'Wedding date is required',
                'promotion_participant.required' => 'Number of guest is required',
                'promotion_details.required' => 'Inquiry Details is required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all)->with('warning', $validator->messages()->first());
            }

            $request['promotion_time'] = Carbon::parse($request['promotion_time'])->isoFormat('h:mm A');
            $filters = [
                'btn_promotion' => 'digit',
                'mice_name' => 'trim|escape|capitalize',
                'promotion_participant' => 'digit',
                'promotion_details' => 'strip_tags',
            ];

            $data = $request->all();
            $sanitizer = new Sanitizer($data, $filters);
            $sanitizer = $sanitizer->sanitize();
            $date_start = $sanitizer['promotion_date'];

            $date_start = Carbon::parse($date_start)->format('Y-m-d');

            $product = Product::where('id', $data['promotion_product'])->first();

            $rsvp_id = rand($min = 1, $max = 99999);
            $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);

            while ($reservation_id == false) {
                $rsvp_id = rand($min = 1, $max = 99999);
                $reservation_id = $this->generate_product_id($rsvp_id, $date_start, $product->product_name, $product->sales_inquiry);
            }

            $created_at = Carbon::now();

            $inquiry = [
                'reservation_id' => $reservation_id,
                'customer_id' => $customer_id,
                'inq_cust_name' => $cust_name,
                'inq_cust_phone' => $cust_phone,
                'product_id' => $data['promotion_product'],
                'inq_type' => $sanitizer['btn_promotion'],
                'inq_event_name' => "Proposal Sheet",
                'inq_participant' => $sanitizer['promotion_participant'],
                'inq_event_start' => $date_start,
                'inq_event_end' => $date_start,
                'inq_arrive_time' => $data['promotion_time'],
                'inq_details' => isset($sanitizer['promotion_details']) ? $sanitizer['promotion_details'] : "",
                'created_at' => $created_at
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
        if($from == "INQUIRY"){
            $setting = Setting::first();
            $data = Inquiry::where('reservation_id', $id)->first();
            $data->from = $from;
            $data->date = Carbon::parse($data->inq_event_start)->isoFormat('dddd, DD MMMM YYYY');
            $data->cust_name = $data->inq_cust_name;
            $data->rsvp_type = "Inquiry";
            $data->subject = 'Inquiry - '.$data->reservation_id;
            $customer = $data->customer->cust_email;

            $to = User::whereNull('deleted_at')->whereIn('level', [0, 1])->pluck('email')->toArray();

            // EMAIL FOR MARKETING/ADMIN
            foreach ($to as $key => $value) {
                Mail::to($value)->send(new ReservationEmail($data, $setting));
            }

            // EMAIL FOR CUSTOMER
            Mail::to($customer)->send(new CustomerEmail($data, $setting));
            return 0;
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
