<?php

use Illuminate\Database\Seeder;

class ReservationVehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservations = App\Reservation::all();

      App\Vehicle::all()->each(function ($vehicle) use ($reservations){
        $vehicle->reservations()->attach(
          $reservations->random(rand(1,3))->pluck('id')->toArray()
        );
      });
    }
}
