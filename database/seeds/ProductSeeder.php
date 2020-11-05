<?php
use App\Models\Product\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $product = ['1 Day Trip', 'Aromatherapy','Massage', 'Residential Package','Non Residential Package','Premium Wedding Package', 'Silver Wedding Package'];
        $category =['1','2','2','3','3','4','4'];

        for ($i = 0; $i < count($product); $i++) {
            //Faker Start
            $product_name = $product[$i];
            $product_desc = $faker->text($maxNbChars = 200);
            $product_category = $category[$i];
            $product_price = $faker->numberBetween($min = 700000, $max = 2000000);
            

            Product::create([
                'product_name' => $product_name,
                'product_detail' => $product_desc,
                'product_price' => $product_price,
                'sales_inquiry' => 1,
                'category' => $product_category
               ]);
            print_r($product_name."\n");
            print_r($product_desc."\n");
            print_r($product_category."\n");
            print_r($product_price."\n");

                

        }
    }
}
