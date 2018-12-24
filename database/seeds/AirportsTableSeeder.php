<?php

use Illuminate\Database\Seeder;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Airport::class, 51)->create();
    }
}
