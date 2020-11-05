<?php

use App\Models\Allotment\Allotment;
use App\Models\Room\Rsvp;
use App\Models\Room\Type;
use App\Models\Customer\Customer;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RsvpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $rooms = Type::orderBy('id', 'DESC')->with('allotment')->get();
        $rooms_id = Type::orderBy('id', 'DESC')->pluck('id')->toArray();
        $status = ['Waiting for payment', 'Payment received'];
        $paymentType = ['Credit Card', 'Transfer'];
        $id_card_type = ['ID card', 'Student card', 'Milter card', 'Driving card'];
        $email = ['example01@gmail.com','example02@gmail.com','example03@gmail.com',
        'example04@gmail.com','example05@gmail.com','example06@gmail.com', 'example07@gmail.com', 
        'example08@gmail.com','example09@gmail.com', 'example10@gmail.com','example11@gmail.com','example12@gmail.com',
        'example13@gmail.com','example14@gmail.com','example15@gmail.com','example16@gmail.com','example17@gmail.com','example18@gmail.com',
        'example19@gmail.com','example20@gmail.com','example21@gmail.com','example22@gmail.com','example23@gmail.com','example24@gmail.com',
        'example25@gmail.com','example26@gmail.com','example27@gmail.com','example28@gmail.com','example29@gmail.com','example30@gmail.com'];
        
        

        


        $total_input = 4000;
        for ($i = 1; $i <= $total_input; $i++) {
            $cust_email = $faker->randomElement($email);
            if(Customer::where('cust_email', $cust_email)->exists()){
                $customer_id = Customer::where('cust_email', $cust_email)->pluck('id')->first();
            }else{
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex   = bin2hex($bytes);
                $customer_id = $hex;
                while(Customer::where('id', $customer_id)->exists()) {
                    $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                    $hex   = bin2hex($bytes);
                    $customer_id = $hex;
                }
                $customer = [
                    'id' => $customer_id,
                    'cust_email' => $cust_email,
                ];
    
                Customer::insert($customer);
            }
            

            $bytes = openssl_random_pseudo_bytes(8, $cstrong);
            $hex   = bin2hex($bytes);
            $booking_id = $hex;
            while(Rsvp::where('booking_id', $booking_id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(5, $cstrong);
                $hex   = bin2hex($bytes);
                $booking_id = $hex;
            }

            $data = [];
            $temp = [];
            $all_grand_total = 0;

            $room_id = $faker->randomElement($rooms_id);
            $get_room = Type::where('id', $room_id)->first();
            $payment = $faker->randomElement($paymentType);
            $date = $faker->dateTimeBetween($startDate = '2020-01-01', $endDate = '+1 years', $timezone = null);
            $date = Carbon::parse($date)->format('Y-m-d');
            // $uniqueNumber = $faker->numberBetween($min = 1, $max = 999);

            $totalDays = $faker->numberBetween($min = 1, $max = 7);
            $totalRooms = $faker->numberBetween($min = 1, $max = 5);
            $adult = $faker->numberBetween($min = 1, $max = (2 * $totalRooms));
            $child = $faker->numberBetween($min = 0, $max = 8);

            $totalExtrabed = $faker->numberBetween($min = 0, $max = 1);
            $roomOnly = $faker->boolean;

            $checkOut = Carbon::parse($date)->addDays($totalDays);

            $cek = $this->availableDate($date, $totalDays, $totalRooms, $room_id);

            $checkIn = $date;
            $query = "select allotment_publish_rate , allotment_ro_rate, allotment_extrabed_rate from allotment where room_id = '" . $room_id . "' and allotment_date >= '" . $date . "' and allotment_date <= '" . $checkOut . "' order by allotment_date";
            $rate_sum = DB::select(DB::raw($query));
            $rate_sum = array_map(function ($value) {
                return (array) $value;
            }, $rate_sum);


            if ($cek) {
                $paymentStatus = $faker->randomElement($status);
            } else {
                $paymentStatus = "Failed";
            }

            if ($payment == "Credit Card") {
                $creditCardNumber = $faker->creditCardNumber;
            } else {
                $creditCardNumber = 0;
            }
            
            $rsvp_id = $faker->randomNumber($nbDigits = 4, $strict = false);
            $reservation_id = $this->generate_id($rsvp_id, $date, $get_room->room_name);

            
            while($reservation_id == false){
                $rsvp_id = $faker->randomNumber($nbDigits = 4, $strict = false);
                $reservation_id = $this->generate_id($rsvp_id, $date, $get_room->room_name);
            }
            
            $reserve_for_other = $faker->boolean;

            $cust_name = $faker->name;
            $cust_id_type = $faker->randomElement($id_card_type);
            $cust_id_no = $faker->nik();
            $cust_email = $faker->freeEmail;
            $cust_phone = $faker->phoneNumber;
            
            if($reserve_for_other){
                $guest_name = $faker->name;
                $guest_email = $faker->freeEmail;
                $guest_phone = $faker->phoneNumber;
            }else{
                $guest_name = null;
                $guest_email = null;
                $guest_phone = null;
    
            }   
            
            $first = true;
            for ($j = 0; $j < ($totalDays - 1); $j++) {
                $rsvp_date_reserve = Carbon::parse($date)->addDays($j)->format('Y-m-d');
                if($first){
                    $create_at = Carbon::parse($rsvp_date_reserve)->isoFormat("YYYY-MM-DD");
                    $time = $faker->time($format = 'H:i:s', $max = 'now');
                    $create_at .= " ".$time;
                }
                if ($roomOnly) {
                    $rsvp_breakfast = 0;
                    $rsvp_publish_rate = $rate_sum[$j]['allotment_ro_rate'];
                } else {
                    $rsvp_breakfast = 1;
                    $rsvp_publish_rate = $rate_sum[$j]['allotment_publish_rate'];
                }

                $extrabedRate = $rate_sum[$j]['allotment_extrabed_rate'];
                $totalExtrabed_rate = $totalExtrabed * $extrabedRate;
                $totalAmountRoom = $rsvp_publish_rate * $totalRooms;
                $totalAmountExtrabed = $totalExtrabed_rate;

                $service_room = floor($totalAmountRoom * 0.1);
                $service_bed = floor($totalAmountExtrabed * 0.1);
                $tax_room = floor(($totalAmountRoom + $service_room) * 0.1);
                $tax_bed = floor(($totalAmountExtrabed + $service_bed) * 0.1);
                $rsvp_tax = $tax_room + $tax_bed;
                $rsvp_service = $service_bed + $service_room;
                $totalAmountRoom = $totalAmountRoom;
                $totalAmountExtrabed = $totalAmountExtrabed;
                
                $grandTotal = $totalAmountRoom + $totalAmountExtrabed + $rsvp_tax + $rsvp_service;
                $all_grand_total += $grandTotal;


                $temp =
                    [
                    'reservation_id' => $reservation_id,
                    'booking_id' => $booking_id,
                    'customer_id' => $customer_id,
                    'room_id' => $room_id,
                    'rsvp_cust_name' => $cust_name,
                    'rsvp_cust_phone' => $cust_phone,
                    'rsvp_cust_idtype' => $cust_id_type,
                    'rsvp_cust_idnumber' => $cust_id_no,
                    'rsvp_guest_name' => $guest_name,
                    'rsvp_date_reserve' => $rsvp_date_reserve,
                    'rsvp_adult' => $adult,
                    'rsvp_child' => $child,
                    'rsvp_breakfast' => $rsvp_breakfast,
                    'rsvp_publish_rate' => $rsvp_publish_rate,
                    'rsvp_extrabed_rate' => $extrabedRate,
                    'rsvp_total_extrabed' => $totalExtrabed,
                    'rsvp_total_room' => $totalRooms,
                    'rsvp_total_amount_room' => $totalAmountRoom,
                    'rsvp_total_amount_extrabed' => $totalAmountExtrabed,
                    'rsvp_tax' => $rsvp_tax,
                    'rsvp_service' => $rsvp_service,
                    'rsvp_tax_total' => ($rsvp_tax + $rsvp_service),
                    'rsvp_payment' => $payment,
                    'rsvp_grand_total' => $grandTotal,
                    'rsvp_status' => $paymentStatus,
                    'create_at' => $create_at
                ];
                array_push($data, $temp);
  
            }


            
            
            

            print_r("name = " . $cust_name . "\n");
            print_r("total day = ". $totalDays."\n");
            print_r("checkin = " . $checkIn . "\n");
            print_r("checkout = " . $checkOut . "\n");
            print_r("reservation id = " . $reservation_id . "\n");
            print_r("payment status = " . $paymentStatus . "\n\n");
            print_r($i / $total_input * 100 . "%");
            Rsvp::insert($data);
        }
    }

    public function availableDate($date, $totalDays, $totalRooms,$room_id)
    {
        $room_total_temp = array();
        $query = "select ";
        for ($i = 0; $i < $totalDays; $i++) {
            if ($i > 0) {
                $query .= ', ';
            }
            $nowDate = Carbon::parse($date)->addDays($i);
            $endDate = Carbon::parse($date)->addDays($totalDays);
            $nowDate = Carbon::parse($nowDate)->format('Y-m-d');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');

            $room = Type::where('room_type.id', $room_id)->where('allotment.allotment_date', $nowDate)->join('allotment', 'room_type.id', '=', 'allotment.room_id')->first();

            if (isset($room) > 0) {
                $room_total_temp[$i] = $room->allotment_room;
            } else {
                $room = Type::where('id', $room_id)->first();

                $day = Carbon::parse($nowDate)->format('l');
                if ($day == "Saturday" || $day == "Sunday") {
                    $room_publish_rate = $room->room_weekend_rate;
                    $room_ro_rate = $room->room_weekend_ro_rate;
                } else {
                    $room_publish_rate = $room->room_publish_rate;
                    $room_ro_rate = $room->room_ro_rate;
                }

                Allotment::create([
                    'room_id' => $room->id,
                    'user_id' => "1",
                    'allotment_room' => $room->room_allotment,
                    'allotment_publish_rate' => $room_publish_rate,
                    'allotment_ro_rate' => $room_ro_rate,
                    'allotment_extrabed_rate' => $room->room_extrabed_rate,
                    'allotment_date' => $nowDate,
                ]);
                $this->availableDate($date, $totalDays, $totalRooms, $room_id);
            }
            $query .= '(select sum(rsvp_total_room) from room_rsvp a where a.room_id = "' . $room_id . '" and a.rsvp_date_reserve >= "' . $nowDate . '" and a.rsvp_date_reserve <= "' . $endDate . '" and rsvp_status <> "Failed") as date_' . $i;
            if ($i == $totalDays) {
                $query .= ' LIMIT 1';
            }
        }

        $rsvp_sum = DB::select(DB::raw($query));
        $rsvp_sum = array_map(function ($value) {
            return (array) $value;
        }, $rsvp_sum)[0];
        $rsvp_sum = array_values($rsvp_sum);
        $room_total_temp = array_values($room_total_temp);

        for ($n = 0; $n < count($room_total_temp); $n++) {
            if ($rsvp_sum[$n] + $totalRooms > $room_total_temp[$n]) {
                return false;
            }
        }
        return true;

    }
    public function generate_id($id, $date, $room_name)
    {
        $generate_id = '';
        switch ($id) {
            case $id < 10:
                $generate_id .= "000" . $id;
                break;
            case $id < 100:
                $generate_id .= "00" . $id;
                break;
            case $id < 1000:
                $generate_id .= "0" . $id;
                break;

            default:
                $generate_id .= $id;
                break;
        }
        $generate_id .= "RSVRM";
        switch ($room_name) {
            case 'Deluxe Business':
                $generate_id .= "1";
                break;
            case 'Deluxe Recreational':
                $generate_id .= "2";
                break;
            case 'Deluxe Mountain':
                $generate_id .= "3";
                break;
            case 'Anindita Suite':
                $generate_id .= "4";
                break;
            case 'Arinandra Suite':
                $generate_id .= "5";
                break;
            case 'Amanda Suite':
                $generate_id .= "6";
                break;
            case 'Audi Cottage':
                $generate_id .= "7";
                break;

            default:
                # code...
                break;
        }
        switch (Carbon::parse($date)->format('m')) {
            case '1':
                $generate_id .= "I";
                break;
            case '2':
                $generate_id .= "II";
                break;
            case '3':
                $generate_id .= "III";
                break;
            case '4':
                $generate_id .= "IV";
                break;
            case '5':
                $generate_id .= "V";
                break;
            case '6':
                $generate_id .= "VI";
                break;
            case '7':
                $generate_id .= "VII";
                break;
            case '8':
                $generate_id .= "VIII";
                break;
            case '9':
                $generate_id .= "IX";
                break;
            case '10':
                $generate_id .= "X";
                break;
            case '11':
                $generate_id .= "XI";
                break;
            case '12':
                $generate_id .= "XII";
                break;
            default:
                # code...
                break;
        }

        $generate_id .= Carbon::parse($date)->format('Y');
        $cek = Rsvp::where('reservation_id', $generate_id)->first();
            if(isset($cek) > 0){
                return false;
            }else{
                return $generate_id;
            }
    }

}
