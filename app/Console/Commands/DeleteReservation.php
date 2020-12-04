<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use Carbon\Carbon;
use DB;

class DeleteReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rsvp:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Reservation that not finished yet';

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
        ProductRsvp::leftJoin('payment', 'product_rsvp.reservation_id', '=', 'payment.booking_id')->whereRaw('rsvp_id is null or reservation_id = ?',[''])->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);
        RoomRsvp::leftJoin('payment', 'room_rsvp.reservation_id', '=', 'payment.booking_id')->whereRaw('rsvp_id is null or reservation_id = ?',[''])->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);

        $time = Carbon::now()->subHour();
        $query = DB::select('select rsvp_id from payment where transaction_time >= ? and transaction_status in ("deny", "cancel") and from_table = "ROOMS"', [$time]);
        $room = $query;
        $room_id = [];
        foreach ($room as $key => $value) {
            array_push($room_id, $value->rsvp_id);
        }
        RoomRsvp::where('expired_at','<', Carbon::now())->whereIn('reservation_id', $room_id)->update(['rsvp_status' => "Failed"]);

        $query = DB::select('select rsvp_id from payment where transaction_time >= ? and transaction_status in ("deny", "cancel") and from_table = "PRODUCTS"', [$time]);
        $product = $query;
        $product_id = [];
        foreach ($product as $key => $value) {
            array_push($product_id, $value->rsvp_id);
        }
        ProductRsvp::where('expired_at','<', Carbon::now())->whereIn('reservation_id', $product_id)->update(['rsvp_status' => "Failed"]);

    }
}
