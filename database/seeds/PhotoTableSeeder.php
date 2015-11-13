<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('photos')->truncate();

        $propertyIds = DB::table('properties')->lists('id');
        $data = [];

        for($i=0; $i<count($propertyIds); $i++) {

            $property_id = array_shift($propertyIds);

            $data[] = [
                    
                    'property_id' => $property_id, 
                    'name' => $faker->text,
                    'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
                    'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker'),
                    'created_at'=> Carbon::now()
                ];

            $data[] = [
                    
                    'property_id' => $property_id, 
                    'name' => $faker->text,
                    'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
                    'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker'),
                    'created_at'=> Carbon::now()
                ];

            $data[] = [
                    
                    'property_id' => $property_id, 
                    'name' => $faker->text,
                    'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
                    'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker'),
                    'created_at'=> Carbon::now()
                ];
            $data[] = [
                    
                    'property_id' => $property_id, 
                    'name' => $faker->text,
                    'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
                    'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker'),
                    'created_at'=> Carbon::now()
                ];

            $data[] = [
                    
                    'property_id' => $property_id, 
                    'name' => $faker->text,
                    'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
                    'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker'),
                    'created_at'=> Carbon::now()
                ];
        }

        DB::table('photos')->insert($data);
    }
}
