<?php

namespace App\Console\Commands;

use DB;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Models\Payment\Payment;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Product\Rsvp as ProductRsvp;

class StatusReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:rsvp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Debit Reservation Status';

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
        $table = DB::table('payment')->whereNotNull('transaction_id')->where('transaction_status', 'pending')->where('payment_type', '!=' , 'Credit Card')->where('expired_at', '<', Carbon::now())->get();

        $booking_id = [];

        foreach ($table as $key => $value) {
            array_push($booking_id, $value->booking_id);
        }

        $where_booking_id = DB::table('payment')->whereIn('booking_id', $booking_id)->get();

        foreach ($where_booking_id as $key => $value) {
            $merchant_id	   = config('faspay.merchantId');
            $merchant_password = config('faspay.merchantPassword');
            $merchant_user	   = 'bot'.$merchant_id;

            $bill_no           = $value->booking_id;
            $from              = $value->from_table;

            $signature         = sha1(md5($merchant_user.$merchant_password.$bill_no));

            $client = new Client();

            // cek url endpoint production or development
            if(config('faspay.endpoint') == true) {
                $url = 'https://web.faspay.co.id/cvr/100004/10';
            } else if (config('faspay.endpoint') == false) {
                $url = 'https://dev.faspay.co.id/cvr/100004/10';
            }

            $response = $client->post($url, [
                'json' => [
                    'request'     => 'Pengecekan Status Pembayaran',
                    'trx_id'      => $value->transaction_id,
                    'merchant_id' => $merchant_id,
                    'bill_no'     => $value->booking_id,
                    'signature'   => $signature
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            Payment::where('booking_id', $bill_no)->update([
                'transaction_status' => $data['payment_status_desc'],
                'fraud_status'       => $data['payment_status_code'],
                'status_code'        => $data['response_code'],
                'status_message'     => $data['response_desc']
            ]);

            if ($value->from_table == "ROOMS") {
                RoomRsvp::where('booking_id', $bill_no)->update([
                    'rsvp_status' => $data['payment_status_desc']
                ]);
            } else {
                ProductRsvp::where('booking_id', $bill_no)->update([
                    'rsvp_status' => $data['payment_status_desc']
                ]);
            }
        }
    }
}
