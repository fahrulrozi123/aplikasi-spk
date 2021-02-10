<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;

use App\Models\Payment\Payment;
use App\Models\Room\Rsvp as RoomRsvp;
use App\Models\Product\Rsvp as ProductRsvp;

class StatusCreditReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit:rsvp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Credit Reservation Status';

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
        // status credit reservation
        $time = Carbon::now()->toDateTimeString();

        $query = "SELECT booking_id, gross_amount, expired_at FROM  (

                    (SELECT payment.booking_id, payment.gross_amount, payment.transaction_status, payment.payment_type, room_rsvp.expired_at
                    FROM payment JOIN room_rsvp
                        ON payment.booking_id = room_rsvp.booking_id
                            WHERE from_table='ROOMS')

                    UNION

                    (SELECT payment.booking_id, payment.gross_amount, payment.transaction_status, payment. payment_type, product_rsvp.expired_at
                    FROM payment JOIN product_rsvp
                        ON payment.booking_id = product_rsvp.booking_id
                            WHERE from_table='PRODUCTS')

                ) A WHERE transaction_status='pending' AND payment_type='Credit Card' AND expired_at < '" . $time . "' ";

        $table = DB::select(DB::raw($query));

        $booking_id = [];

        foreach ($table as $key => $value) {
            array_push($booking_id, $value->booking_id);
        }

        $where_booking_id = DB::table('payment')->whereIn('booking_id', $booking_id)->get();

        foreach ($where_booking_id as $key => $value) {
            $merchant_id = config('faspay.merchantIdCredit');
            $password    = config('faspay.merchantPasswordCredit');
            $tranid      = $value->booking_id;
            $amount      = $value->gross_amount;
            $signaturecc = sha1('##'.strtoupper($merchant_id).'##'.strtoupper($password).'##'.$tranid.'##'.$amount.'##'.'0'.'##');

            $post = array(
                'TRANSACTIONTYPE' => '4',
                'RESPONSE_TYPE'   => '3',
                'MERCHANTID'      => $merchant_id,
                'PAYMENT_METHOD'  => '1',
                'MERCHANT_TRANID' => $tranid,
                'AMOUNT'          => $amount,
                'SIGNATURE'       => $signaturecc
            );

            $post   = http_build_query($post);

            if(config('faspay.endpoint') == true) {
                $endpoint = 'https://fpg.faspay.co.id/payment/api';
            } else {
                $endpoint = 'https://fpgdev.faspay.co.id/payment/api';
            }

            $url = $endpoint;
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result  = curl_exec($ch);
            curl_close($ch);
            $arr1    = explode(';',$result);
            $res_arr = array();

            foreach($arr1 as $val)
            {
                $arr2=explode('=',$val);
                $res_arr[$arr2[0]]=$arr2[1];
            }

            if($res_arr !== '') {

                if ($res_arr['TXN_STATUS'] == 'S') {
                    $status_payment = 'settlement';
                } else {
                    $status_payment = 'Failed';
                }

                $transaction_id = $res_arr['TRANSACTIONID'] !== '0' ? $res_arr['TRANSACTIONID'] : null;

                Payment::where('booking_id', $tranid)->update([
                    'transaction_status' => $status_payment,
                    'transaction_id'     => $transaction_id,
                ]);

                if ($value->from_table == "ROOMS") {
                    RoomRsvp::where('booking_id', $tranid)->update([
                        'rsvp_status' => $status_payment
                    ]);
                } else {
                    ProductRsvp::where('booking_id', $tranid)->update([
                        'rsvp_status' => $status_payment
                    ]);
                }
            }

        }
    }
}
