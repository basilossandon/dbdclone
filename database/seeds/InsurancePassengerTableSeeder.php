<?php

use Illuminate\Database\Seeder;

class InsurancePassengerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $insurances = App\Insurance::all();

         App\Passenger::all()->each(function ($passenger) use ($insurances){
           $idsArray = $insurances->random(rand(1,3))->pluck('id')->toArray();
           foreach($idsArray as $id){
             $passenger->insurances()->attach($id, [
               'flight_id' => App\Flight::all()->random()->id
             ]);
           }
         });
     }
}
