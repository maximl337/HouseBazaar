<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->truncate();
        
        factory('App\Property', 100)
                ->create()
                ->each(function($u) {

                    $u->photos()->save(factory('App\Photo')->make());
                    
                    $u->photos()->save(factory('App\Photo')->make());

                    $u->photos()->save(factory('App\Photo')->make());

                    $u->photos()->save(factory('App\Photo')->make());

                    $u->photos()->save(factory('App\Photo')->make());

                });
    }
}
