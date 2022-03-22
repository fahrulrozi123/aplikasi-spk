<?php

namespace App\Http\Controllers\Testing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Carbon\Carbon;

use App\Models\Setting\Setting;
use App\Models\Payment\Payment;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Product\Rsvp as ProductRsvp;

class TestingFeatureController extends Controller
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

    public function checkAllotment()
    {
        // $date = Carbon::Now();
        // $dateNow = Carbon::parse($date)->format('Y-m-d');
        // $allotment_date = Carbon::parse($date)->toDateTimeString();

        // var_dump($dateNow);
        // echo "<br>";
        // var_dump($allotment_date);
        // die();

        // parameter data
        $date = Carbon::Now();

        $allotment_date = Carbon::parse($date)->format('Y-m-d');
        $created_at     = Carbon::parse($date)->toDateTimeString();
        $current_date   = Carbon::parse($date)->format('Y-m-d');

        $sql = "INSERT INTO allotment(room_id, user_id, allotment_room, allotment_publish_rate, allotment_ro_rate, allotment_extrabed_rate,  allotment_date, create_at)

        SELECT
            roomAvailability.id roomID,
            1,
            CASE
                WHEN COALESCE(todayAllotment.ID,0) <> 0 THEN allotment_room
                ELSE dayAllotment
            END todayAllotment,
            CASE
                WHEN COALESCE(todayAllotment.ID,0) <> 0 THEN allotment_publish_rate
                ELSE dayPublishRate
            END todayPublishRate,
            CASE
                WHEN COALESCE(todayAllotment.ID,0) <> 0 THEN allotment_ro_rate
                ELSE dayRoomRate
            END todayRoomRate,
            CASE
                WHEN COALESCE(todayAllotment.ID,0) <> 0 THEN allotment_extrabed_rate
                ELSE room_extrabed_rate
            END todayExtraBedRate,
            '" . $allotment_date . "' ,
            '" . $created_at . "'
        FROM (

        SELECT
            id,
            room_allotment,
            room_name,
            CASE
                WHEN room_future_availability <> 0 AND '" . $allotment_date . "'  <= DATE_ADD('" . $current_date . "' , INTERVAL room_future_availability MONTH) THEN room_allotment
                ELSE 0
            END dayAllotment,
            CASE
                WHEN DAYNAME('" . $allotment_date . "' ) = 'Friday' OR DAYNAME('" . $allotment_date . "' ) = 'Saturday' OR DAYNAME('" . $allotment_date . "' ) = 'Sunday' THEN room_weekend_rate
                ELSE room_publish_rate
            END dayPublishRate,
            CASE
                WHEN DAYNAME('" . $allotment_date . "' ) = 'Friday' OR DAYNAME('" . $allotment_date . "' ) = 'Saturday' OR DAYNAME('" . $allotment_date . "' ) = 'Sunday' THEN room_weekend_ro_rate
                ELSE room_ro_rate
            END dayRoomRate,
            room_extrabed_rate,
            '" . $allotment_date . "'
            FROM room_type
        ) roomAvailability

        LEFT JOIN
            (SELECT
                allotment.id,
                room_id,
                allotment_room,
                allotment_publish_rate,
                allotment_ro_rate,
                allotment_extrabed_rate
                FROM allotment
                WHERE allotment_date = '" . $allotment_date . "' ) todayAllotment
                ON roomAvailability.id = todayAllotment.room_id
        WHERE COALESCE(todayAllotment.ID, 0) = 0 ";

        $return = (DB::insert(DB::raw($sql)));
    }
}
