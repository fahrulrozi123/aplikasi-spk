<?php

namespace App\Console\Commands;

use DB;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckAllotment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:allotment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Allotment Every Day 23.00 WIB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // check allotment today
        $date = Carbon::Now();

        $allotment_date = Carbon::parse($date)->format('Y-m-d');
        $created_at     = Carbon::parse($date)->toDateTimeString();
        $current_date   = Carbon::parse($date)->format('Y-m-d');

        $sql = "INSERT INTO allotment(room_id, user_id, allotment_room, allotment_publish_rate, allotment_ro_rate, allotment_extrabed_rate,  allotment_date, created_at)

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

        DB::insert(DB::raw($sql));

        // check allotment tomorrow
        $date_t = Carbon::Now();
        $date_t->addDays(1);
        $allotment_date_t = Carbon::parse($date_t)->format('Y-m-d');
        $created_at_t     = Carbon::parse($date_t)->toDateTimeString();
        $current_date_t   = Carbon::parse($date_t)->format('Y-m-d');

        $sql_t = "INSERT INTO allotment(room_id, user_id, allotment_room, allotment_publish_rate, allotment_ro_rate, allotment_extrabed_rate,  allotment_date, created_at)

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
            '" . $allotment_date_t . "' ,
            '" . $created_at_t . "'
        FROM (

        SELECT
            id,
            room_allotment,
            room_name,
            CASE
                WHEN room_future_availability <> 0 AND '" . $allotment_date_t . "'  <= DATE_ADD('" . $current_date_t . "' , INTERVAL room_future_availability MONTH) THEN room_allotment
                ELSE 0
            END dayAllotment,
            CASE
                WHEN DAYNAME('" . $allotment_date_t . "' ) = 'Friday' OR DAYNAME('" . $allotment_date_t . "' ) = 'Saturday' OR DAYNAME('" . $allotment_date_t . "' ) = 'Sunday' THEN room_weekend_rate
                ELSE room_publish_rate
            END dayPublishRate,
            CASE
                WHEN DAYNAME('" . $allotment_date_t . "' ) = 'Friday' OR DAYNAME('" . $allotment_date_t . "' ) = 'Saturday' OR DAYNAME('" . $allotment_date_t . "' ) = 'Sunday' THEN room_weekend_ro_rate
                ELSE room_ro_rate
            END dayRoomRate,
            room_extrabed_rate,
            '" . $allotment_date_t . "'
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
                WHERE allotment_date = '" . $allotment_date_t . "' ) todayAllotment
                ON roomAvailability.id = todayAllotment.room_id
        WHERE COALESCE(todayAllotment.ID, 0) = 0 ";

        DB::insert(DB::raw($sql_t));
    }
}
