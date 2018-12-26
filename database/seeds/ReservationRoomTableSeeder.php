<?php

use Illuminate\Database\Seeder;

class ReservationRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $reservations = App\Reservation::all();
       $faker = Faker\Factory::create('en_US');

       App\Vehicle::all()->each(function ($vehicle) use ($reservations, $faker){
         $idsArray = $reservations->random(rand(1,3))->pluck('id')->toArray();
         foreach($idsArray as $id){
           $vehicle->reservations()->attach($id, [
             'reservation_room_lease' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
             'reservation_room_return' => $faker->dateTimeBetween($startDate = '+ 1 days', $endDate = '+ 30 days'),
           ]);
         }
       });
     }
   }
