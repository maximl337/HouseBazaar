<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PropertyTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_tags')->truncate();

        /* SEED PIVOT */
        $eventIds = DB::table('properties')->lists('id');
        $tagIds = DB::table('tags')->lists('id');

        $pivots = [];
        foreach($eventIds as $eventId)
        {
            //necessary since shuffle() and array_shift() take an array by reference
            $randomizedTagIds = $tagIds;

            shuffle($randomizedTagIds);
            for($index = 0; $index < 3; $index++) {
                $pivots[] = [
                    
                    'tag_id' => array_shift($randomizedTagIds), 
                    'property_id' => $eventId,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now(),
                ];
            }
        }

        DB::table('property_tags')->insert($pivots); 
    }
}
