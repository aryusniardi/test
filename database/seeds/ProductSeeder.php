<?php

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
        $products = [];     
        $faker = Faker\Factory::create();     
        
        for($i=0; $i < 20; $i++) {         
            $product_name = $faker->sentence(mt_rand(2, 4));
            $product_name = str_replace('.', '', $product_name);
            $photo_path = public_path() . '\storage';
            $photo_fullpath = $faker->image( $photo_path, 300, 400);
            $photo = str_replace($photo_path, '', $photo_fullpath);
            $products[$i] = [
                'product_name' => $product_name,
                'product_desc' => $faker->text(255),
                'product_image' => $photo,
                'product_price' => mt_rand(1, 10) * 50000,
                'created_at' => Carbon\Carbon::now(),
            ];     
        }     
        DB::table('products')->insert($products);
    }
}
