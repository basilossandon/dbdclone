<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = factory(App\Package::class, 10)->create();
        $packages->each(function ($package){
            $roomsId = App\Room::all()->random(rand(1,3))->pluck('id')->toArray();
            foreach($roomsId as $id){
                $package->rooms()->attach($id);
            }
            // Crear un ticket "no comprado" (passenger_id = null, reservation_id = null,
            // seat_id = null, seat_letter = null)
            $ticket = new App\Ticket;
            $ticket->package_id = $package->id;
            $ticket->seat_id = App\Seat::all()->random()->id;
            $ticket->flight_id = App\Flight::all()->random()->id;
            $ticket->save();
        });
    }
}
