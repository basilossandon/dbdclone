<?php

use Illuminate\Database\Seeder;

class FlightSeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seatsId = App\Seat::all()->pluck('id')->toArray();
        App\Flight::all()->each(function ($flight) use ($seatsId) {
            foreach($seatsId as $seatId){
                $flight->seats()->attach($seatId,
                [
                    'seat_type_capacity' => $flight->flight_capacity/3
                ]);
            }
        });
    }
}
