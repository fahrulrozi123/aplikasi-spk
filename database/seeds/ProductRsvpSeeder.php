<?php

use App\Models\Allotment\Allotment;
use App\Models\Product\Rsvp;
use App\Models\Product\Product;
use App\Models\Customer\Customer;
use App\Models\Inquiry\Inquiry;
use App\Models\FunctionRoom\FunctionRoom;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductRsvpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $id_card_type = ['ID card', 'Student card', 'Milter card', 'Driving card'];
        
        $product_id = Product::orderBy('id', 'DESC')->pluck('id')->toArray();
        $function_id = FunctionRoom::orderBy('id', 'DESC')->pluck('id')->toArray();

        $mice_event_type = ['Meeting', 'Incentive', 'Conference', 'Other'];
        
        $status = ['Refunded', 'Rescheduled', 'Waiting for payment', 'Payment received', 'Failed'];
        $paymentType = ['Credit Card', 'Transfer'];
        $email = ['example01@gmail.com','example02@gmail.com','example03@gmail.com',
        'example04@gmail.com','example05@gmail.com','example06@gmail.com', 'example07@gmail.com', 
        'example08@gmail.com','example09@gmail.com', 'example10@gmail.com','example11@gmail.com','example12@gmail.com',
        'example13@gmail.com','example14@gmail.com','example15@gmail.com','example16@gmail.com','example17@gmail.com','example18@gmail.com',
        'example19@gmail.com','example20@gmail.com','example21@gmail.com','example22@gmail.com','example23@gmail.com','example24@gmail.com',
        'example25@gmail.com','example26@gmail.com','example27@gmail.com','example28@gmail.com','example29@gmail.com','example30@gmail.com'];
        $total_input = 10000;
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
            $id = $faker->randomElement($product_id);
            $product = Product::where('id', $id)->first();
            $payment = $faker->randomElement($paymentType);
            $date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null);
            $date = Carbon::parse($date)->format('Y-m-d');
            $paymentStatus = $faker->randomElement($status);

            $date_reserve = $date;
            $create_at = Carbon::parse($date_reserve)->isoFormat("YYYY-MM-DD");
            $time = $faker->time($format = 'H:i:s', $max = 'now');
            $create_at .= " ".$time;

            $rsvp_pax_price = $product->product_price;
            $rsvp_amount_pax = $faker->numberBetween($min = 1, $max = 50);
            $rsvp_total_amount = $rsvp_pax_price * $rsvp_amount_pax;


            $rsvp_service = floor($rsvp_total_amount * 0.1);
            $rsvp_tax = floor(($rsvp_total_amount + $rsvp_service) * 0.1);


            if ($payment == "Credit Card") {
                $creditCardNumber = $faker->creditCardNumber;
            } else {
                $creditCardNumber = 0;
            }

            $rsvp_total_amount = $rsvp_total_amount - $rsvp_service - $rsvp_tax;
            $grandTotal = $rsvp_total_amount + $rsvp_tax + $rsvp_service;

          $rsvp_id = $faker->randomNumber($nbDigits = 5, $strict = false);
          $reservation_id = $this->generate_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);

          while($reservation_id == false){
              $rsvp_id = $faker->randomNumber($nbDigits = 5, $strict = false);
              $reservation_id = $this->generate_id($rsvp_id, $date, $product->product_name, $product->sales_inquiry);
          }

          $reserve_for_other = $faker->boolean;

            $cust_name = $faker->name;
            $cust_id_type = $faker->randomElement($id_card_type);
            $cust_id_no = $faker->nik();
            $cust_email = $faker->freeEmail;
            $cust_phone = $faker->phoneNumber;
            
            if($reserve_for_other){
                $guest_name = $faker->name;
                $guest_email = $cust_email;
                $guest_phone = $cust_phone;
            }else{
                $guest_name = null;
                $guest_email = null;
                $guest_phone = null;
    
            }
            

          print_r("name = ". $cust_name."\n");
          print_r("date_reserve = ". $date_reserve."\n");
          print_r("payment status = ".$paymentStatus."\n\n");
          print_r($i / $total_input * 100 ."%");
          if($product->sales_inquiry == 1){
            print_r("inquiry");

            $inq_details = $faker->text($maxNbChars = 200);
            switch ($product->category) {
                case 1:
                    $func_id = null;
                    $inq_product_id = $product->id;
                    $inq_type = 1;
                    $inq_total = null;
                    $inq_event_name = null;
                    $inq_event_type = null;
                    $inq_participant = $rsvp_amount_pax;
                    $inq_event_start = $date_reserve;
                    $inq_event_end = $date_reserve;
                    //for generate alternative
                    $date_reserve = $faker->dateTimeBetween($startDate = $date_reserve, $endDate = '+1 years', $timezone = null);
                    $inq_alt_start = $date_reserve;
                    $inq_alt_end = $date_reserve;
                    $inq_budget = null;
                break;

                case 2:
                    $func_id = null;
                    $inq_product_id = $product->id;
                    $inq_type = 2;
                    $inq_total = null;
                    $inq_event_name = null;
                    $inq_event_type = null;
                    $inq_participant = $rsvp_amount_pax;
                    $inq_event_start = $date_reserve;
                    $inq_event_end = $date_reserve;
                    //for generate alternative
                    $date_reserve = $faker->dateTimeBetween($startDate = $date_reserve, $endDate = '+1 years', $timezone = null);
                    $inq_alt_start = $date_reserve;
                    $inq_alt_end = $date_reserve;
                    $inq_budget = null;
                break;

                case 3:
                    $use_function_room = $faker->boolean;

                    if($use_function_room){
                        $inq_function = $faker->randomElement($function_id);
                    }else{
                        $inq_function = null;
                    }
                    $mice_event = $faker->randomElement($mice_event_type);
                    $event_name = "Annual ".$mice_event;
                    $func_id = $inq_function;
                    $inq_product_id = $product->id;
                    $inq_type = 3;
                    $inq_total = null;
                    $inq_event_name = $event_name;
                    $inq_event_type = $mice_event;
                    $inq_participant = $rsvp_amount_pax;
                    $inq_event_start = $date_reserve;
                    $inq_event_end = $date_reserve;
                    //for generate alternative
                    $date_reserve = $faker->dateTimeBetween($startDate = $date_reserve, $endDate = '+1 years', $timezone = null);
                    $inq_alt_start = $date_reserve;
                    $inq_alt_end = $date_reserve;
                    $inq_budget = $faker->numberBetween($min = 1000000, $max = 10000000);
                break;

                case 4:
                    $id = $faker->randomElement($product_id);
                    $func_id = null;
                    $inq_product_id = $product->id;
                    $inq_type = 4;
                    $inq_total = null;
                    $inq_event_name = "Wedding";
                    $inq_event_type = null;
                    $inq_participant = $rsvp_amount_pax;
                    $inq_event_start = $date_reserve;
                    $inq_event_end = $date_reserve;
                    //for generate alternative
                    $date_reserve = $faker->dateTimeBetween($startDate = $date_reserve, $endDate = '+1 years', $timezone = null);
                    $inq_alt_start = $date_reserve;
                    $inq_alt_end = $date_reserve;
                    $inq_budget = null;
                break;
                
                default:
                    # code...
                break;
            }
            $inquiry = [
                'reservation_id' => $reservation_id,
                'customer_id' => $customer_id,
                'function_room_id' => $func_id,
                'product_id' => $inq_product_id,
                'inq_cust_name' => $cust_name,
                'inq_cust_phone' => $cust_phone,
                'inq_type' => $inq_type,
                'inq_event_name'=> $inq_event_name,
                'inq_event_type'=> $inq_event_type,
                'inq_participant'=> $inq_participant,
                'inq_event_start'=> $inq_event_start,
                'inq_event_end'=> $inq_event_end,
                'inq_alt_start'=> $inq_alt_start,
                'inq_alt_end'=> $inq_alt_end,
                'inq_budget'=> $inq_budget,
                'inq_details'=> $inq_details,
                'create_at' => $create_at
            ];
            Inquiry::insert($inquiry);

          }else{
            Rsvp::create([
                'reservation_id' =>$reservation_id,
                'booking_id' =>$booking_id,
                'customer_id' => $customer_id,
                'product_id' => $id,
                'rsvp_date_reserve' => $date_reserve,
                'rsvp_cust_name' => $cust_name,
                'rsvp_cust_phone' => $cust_phone,
                'rsvp_cust_idtype' => $cust_id_type,
                'rsvp_cust_idnumber' => $cust_id_no,
                'rsvp_guest_name' => $guest_name,
                'rsvp_amount_pax' => $rsvp_amount_pax,
                'rsvp_pax_price' => $rsvp_pax_price,
                'rsvp_total_amount' => $rsvp_total_amount,
                'rsvp_tax' => $rsvp_tax,
                'rsvp_service' => $rsvp_service,
                'rsvp_tax_total' => ($rsvp_tax + $rsvp_service),
                'rsvp_payment' => $payment,
                'rsvp_grand_total' => $grandTotal,
                'rsvp_status' => $paymentStatus,
                'create_at' => $create_at
            ]);
          }
        }
    }
    public function generate_id($id, $date, $product_name, $inquiry)
    {
        $generate_id = "";
        switch ($id) {
            case $id < 10:
                $generate_id .= "0000" . $id;
                break;
            case $id < 100:
                $generate_id .= "000" . $id;
                break;
            case $id < 1000:
                $generate_id .= "00" . $id;
                break;
            case $id < 10000:
                $generate_id .= "0" . $id;
                break;

            default:
                $generate_id .= $id;
                break;
        }
        if($inquiry == 0){
            $generate_id .= "RSVPD";
        }else{
            $generate_id .= "INQPD";
        }
        switch ($product_name) {
            case '1 Day Trip':
                $generate_id .= "REC1";
                break;
            case 'Aromatherapy':
                $generate_id .= "ALS2";
                break;
            case 'Massage':
                $generate_id .= "ALS2";
                break;
            case 'Residential Package':
                $generate_id .= "MIC1";
                break;
            case 'Non Residential Package':
                $generate_id .= "MIC2";
                break;
            case 'Premium Wedding Package':
                $generate_id .= "WED1";
                break;
            case 'Silver Wedding Package':
                $generate_id .= "WED2";
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
        if($inquiry == 0){
            $cek = Rsvp::where('reservation_id', $generate_id)->first();
        }else{
            $cek = Inquiry::where('reservation_id', $generate_id)->first();
        }
        if(isset($cek)){
            return false;
        }else{
            return $generate_id;
        }
        return $generate_id;
    }

}
