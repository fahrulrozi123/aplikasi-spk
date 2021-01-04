<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $table = DB::table('payment')->select('booking_id')->where('transaction_status', 'pending')->where('payment_type', 'Credit Card')->get();

        $booking_id = [];

        foreach ($table as $key => $value) {
            array_push($booking_id, $value->booking_id);
        }

        $where_booking_id = DB::table('payment')->whereIn('booking_id', $booking_id)->get();

        // dd($table);
        // dd($where_booking_id);
        // $signaturecc = sha1('##'.strtoupper('test_migs_non').'##'.strtoupper('abcde').'##2017091850745##1000.00##'.'0'.'##');
        // $merchant_id = config('faspay.merchantIdCredit');
        // $password    = config('faspay.merchantPasswordCredit');

        foreach ($where_booking_id as $key => $value) {
            $merchant_id    = config('faspay.merchantIdCredit');
            $password       = config('faspay.merchantPasswordCredit');

            $tranid         = $value->booking_id;
            $data_amount    = $value->gross_amount;
            $amount         = number_format( (float) $data_amount, 2, '.', '');
            $transaction_id = $value->transaction_id;

            $signaturecc    = sha1('##'.strtoupper($merchant_id).'##'.strtoupper($password).'##'.$tranid.'##'.$amount.'##'.'0'.'##');

            $post = array(
                "TRANSACTIONTYPE" => '4',
                "RESPONSE_TYPE"   => '3',
                "MERCHANTID"      => $merchant_id,
                "PAYMENT_METHOD"  => '1',
                "MERCHANT_TRANID" => $tranid,
                "TRANSACTIONID"   => $transaction_id,
                "AMOUNT"          => $amount,
                "SIGNATURE"       => $signaturecc
            );

            $post   = http_build_query($post);
            $url    = "https://fpg.faspay.co.id/payment/api";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($ch);
            // print_r($result);
            curl_close($ch);

            $arr1 = explode(';',$result);

            $res_arr = array();

            foreach($arr1 as $val)
            {
                $arr2=explode('=',$val);
                $res_arr[$arr2[0]]=$arr2[1];
            }

            // dd($res_arr);

            Payment::where('booking_id', $tranid)->update([
                'transaction_status' => $res_arr['payment_status_desc']
            ]);

            if ($value->from_table == "ROOMS") {
                RoomRsvp::where('booking_id', $tranid)->update([
                    'rsvp_status' => $res_arr['payment_status_desc']
                ]);
            } else {
                ProductRsvp::where('booking_id', $tranid)->update([
                    'rsvp_status' => $res_arr['payment_status_desc']
                ]);
            }
        }
    }
}
