<?php
use App\Models\Room\Bed;
use App\Models\Room\Type;
use App\Models\Room\RoomAmenities;
use App\Models\Amenities\Amenities;
use App\Models\Room\Photo;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $room = ['Deluxe Business', 'Deluxe Recreational', 'Deluxe Mountain', 'Anindita Suite', 'Arinandra Suite', 'Amanda Suite', 'Audi Cottage'];
        $bed_type = [0, 1, 2];
        $availbility = [0, 6, 12, 24];
        $amenities_list = Amenities::pluck('id')->toArray();
        $default_photo = "room_default.jpeg";

        for ($i = 0; $i < count($room); $i++) {
            //select id
            $id = $faker->numberBetween($min = 1, $max = 99999);
            $cek = Type::where('id', $id)->get();

            //if ID is exist create new ID then check until not exist
            while (count($cek) > 0) {
                $id = $faker->numberBetween($min = 1, $max = 99999);
                $cek = Type::where('id', $id)->get();
            }

            //Faker Start
            $room_name = $room[$i];

            $bed = [];
            $bed_temp = 0;

            //how much bed type
            $bed_total = $faker->numberBetween($min = 1, $max = 3);
            //select bed
            for ($j = 0; $j < $bed_total; $j++) {
                $bed_temp = $faker->randomElement($bed_type);
                while (in_array($bed_temp, $bed)) {
                    $bed_temp = $faker->randomElement($bed_type);
                }
                print_r(in_array($bed_temp, $bed));
                array_push($bed, $bed_temp);
            }

            //how much amenities
            $amenities_total = $faker->numberBetween($min = 1, $max = count($amenities_list));

            $amenities = [];
            $amenities_temp = 0;

            //select amenities
            for ($j = 0; $j < $amenities_total; $j++) {
                $amenities_temp = $faker->randomElement($amenities_list);
                while (in_array($amenities_temp, $amenities)) {
                    $amenities_temp = $faker->randomElement($amenities_list);
                }
                array_push($amenities, $amenities_temp);
            }


            $room_desc = $faker->text($maxNbChars = 200);
            $future_availability = $faker->randomElement($availbility);
            $base_allotment = $faker->numberBetween($min = 1, $max = 10);
            $base_publish_rate = $faker->numberBetween($min = 700000, $max = 2000000);
            $base_ro_rate = $faker->numberBetween($min = 500000, $max = 1500000);
            $base_weekend_rate = $faker->numberBetween($min = 850000, $max = 2200000);
            $base_weekend_ro_rate = $faker->numberBetween($min = 700000, $max = 2000000);
            $base_extrabed_rate = $faker->numberBetween($min = 100000, $max = 300000);

            while ($base_publish_rate > $base_weekend_rate && $base_ro_rate > $base_weekend_ro_rate) {
                $base_weekend_rate = $faker->numberBetween($min = 850000, $max = 2200000);
                $base_weekend_ro_rate = $faker->numberBetween($min = 700000, $max = 2000000);
            }

            print_r("room = " . $room_name . "\n");
            print_r("total bed = " . $bed_total . "\n");
            foreach ($bed as $key => $value) {
                switch ($value) {
                    case 0:
                        $name = "King";
                        break;
                    case 1:
                        $name = "Queen";
                        break;
                    case 2:
                        $name = "Twin";
                        break;

                    default:
                        # code...
                        break;
                }
                print_r("bed = " . $name . "\n");
            }
            print_r("\n\n");
            Type::create([
                'id' => $id,
                'room_name' => $room_name,
                'room_desc' => $room_desc,
                'room_allotment' => $base_allotment,
                'room_publish_rate' => $base_publish_rate,
                'room_ro_rate' => $base_ro_rate,
                'room_weekend_rate' => $base_weekend_rate,
                'room_weekend_ro_rate' => $base_weekend_ro_rate,
                'room_extrabed_rate' => $base_extrabed_rate,
                'room_future_availability' => $future_availability,
            ]);

            foreach ($bed as $key => $value) {
                Bed::create([
                    'room_id' => $id,
                    'bed_id' => $value,
                ]);
            }

            foreach ($amenities as $key => $value) {
                RoomAmenities::create([
                    'room_id' => $id,
                    'amenities_id' => $value,
                ]);
            }
            
            //insert default_photo to room
            Photo::create([
                'room_id' => $id,
                'photo_path' => $default_photo,
            ]);
        }
    }
}
