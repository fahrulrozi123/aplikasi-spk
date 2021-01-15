<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product\Rsvp as ProductRsvp;
use App\Models\Room\Rsvp as RoomRsvp;
use Carbon\Carbon;
use DB;

class InvalidReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invalid:rsvp';

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
        // Room
        RoomRsvp::whereNull('reservation_id')->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);
        RoomRsvp::whereRaw('rsvp_payment is null')->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);

        // Product
        ProductRsvp::whereNull('reservation_id')->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);
        ProductRsvp::whereRaw('rsvp_payment is null')->where('expired_at', '<', Carbon::now())->update(['rsvp_status' => "Failed"]);
    }
}
