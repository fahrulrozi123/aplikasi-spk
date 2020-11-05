<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Customer\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = $this->setting();
        return view('index', get_defined_vars());
    }

    public function reservation_this_month()
    {
        $query = "SELECT DISTINCT room.id,
                    room.room_name,
                    (SELECT photo_path
                    FROM   room_photo
                    WHERE  room_id = room.id
                    ORDER  BY room_id
                    LIMIT  1) AS photo_path,
                    (SELECT Count(DISTINCT room_rsvp.reservation_id)
                    FROM   room_rsvp
                    WHERE  rsvp_date_reserve >= Date_add(Curdate(), INTERVAL - Day(Curdate()) + 1 day)
                            AND rsvp_date_reserve <= Last_day(Curdate())
                            AND rsvp_status = 'Payment received'
                            AND room_id = room.id)          AS total_reserve,
                    (SELECT ( Ifnull(Sum(allotment_room), IF(room.room_future_availability > 0, room.room_allotment, 0)) - (SELECT DISTINCT
                                                    Ifnull(Sum(rsvp_total_room), 0)
                                                    FROM   room_rsvp
                                                    WHERE  room_id = room.id
                                                            AND
                                                    room_rsvp.rsvp_date_reserve =
                                                    Curdate()
                                                            AND rsvp_status =
                                                                'Payment received')
                            )
                    FROM   allotment
                    WHERE  room_id = room.id
                            AND allotment_date = Curdate()) AS allotment_remaining
        FROM   room_type room
        ORDER  BY room.room_name; ";

        $reservation = DB::select(DB::raw($query));

        return $reservation;
    }

    public function online_product_today()
    {

        $query = "SELECT rsvp.reservation_id,
        rsvp.rsvp_cust_name,
        rsvp.rsvp_date_reserve,
        product.product_name
        FROM product_rsvp rsvp
                JOIN product
                ON rsvp.product_id = product.id
        WHERE  rsvp.rsvp_date_reserve = Curdate()
                AND rsvp.rsvp_status = 'Payment received'
        ORDER  BY product.product_name ASC;";

        $products = DB::select(DB::raw($query));

        return $products;
    }

    public function offline_product_today()
    {

        $query = "SELECT *
        FROM   inquiry inq
                LEFT JOIN product
                ON inq.product_id = product.id
                LEFT JOIN customer
                ON inq.customer_id = customer.id
        WHERE  inq.inq_event_start = Curdate()
        ORDER BY inq.inq_type;";

        $inquiry = DB::select(DB::raw($query));


        return $inquiry;
    }
    public function room_today()
    {

        $query = "SELECT DISTINCT customer.*, rsvp.rsvp_cust_name, rsvp.rsvp_cust_phone,
                            rsvp.rsvp_guest_name, rsvp.reservation_id,
                            rsvp.rsvp_adult, rsvp.rsvp_child,
                            rsvp.customer_id,
                            rsvp.rsvp_status,
                            Concat(rsvp.rsvp_total_room, 'x ', room.room_name) AS
                            rsvp_reserved_room,
                            (SELECT b.rsvp_date_reserve
                            FROM   room_rsvp b
                            WHERE  b.reservation_id = rsvp.reservation_id
                            ORDER  BY b.rsvp_date_reserve
                            LIMIT  1) AS
                            rsvp_checkin,
                            (SELECT Date_add(b.rsvp_date_reserve, INTERVAL 1 day)
                            FROM   room_rsvp b
                            WHERE  b.reservation_id = rsvp.reservation_id
                            ORDER  BY b.rsvp_date_reserve DESC
                            LIMIT  1) AS
                            rsvp_checkout
                    FROM   room_rsvp rsvp
                    JOIN room_type room
                    ON EXISTS (SELECT 1
                                FROM  room_rsvp
                                WHERE  (room_rsvp.reservation_id = rsvp.reservation_id )
                                    AND ( room.id = room_rsvp.room_id ))
                    LEFT JOIN customer
                        ON rsvp.customer_id = customer.id
                    WHERE  rsvp.rsvp_status = 'Payment received'
                    AND rsvp.rsvp_date_reserve = Curdate()
                    AND rsvp_date_reserve   =
                    (SELECT b.rsvp_date_reserve
                    FROM   room_rsvp b
                    WHERE  b.reservation_id = rsvp.reservation_id
                    ORDER  BY b.rsvp_date_reserve
                    LIMIT  1)
                    ORDER  BY rsvp.reservation_id;";

        $rooms = DB::select(DB::raw($query));
        return $rooms;
    }
}
