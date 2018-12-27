<?php

use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Crea reservas relacionadas con un paquete
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_US');
        $reservations = factory('App\Reservation', 20)->create();
        $reservations->each(function ($reservation) use ($faker){
            // A cada reserva le asigna el id de un paquete
            $packageId = App\Package::all()->random()->id;
            $reservation->package_id = $packageId;
            $reservation->save();
            /*
             Relacionamos cada servicio asociado a paquete con reserva, a traves
            */

            // Relacion reservation-room
            $package = App\Package::where('id', $packageId)->first();
            foreach($package->rooms as $room){
                $reservation->rooms()->attach($room->id, [
                    'reservation_room_lease' => $faker->dateTimeBetween($startDate = '-1 years',
                    $endDate = 'now'),
                    'reservation_room_return' => $faker->dateTimeBetween($startDate = '+ 1 days',
                    $endDate = '+ 30 days'),
                ]);
            }

            // Relacion reservation-vehicle
            $vehicle = App\Package::where('id', $packageId)->first()->vehicle()->first();
            $reservation->vehicles()->attach($vehicle->id, [
                'vehicle_reservation_lease' => $faker->dateTimeBetween($min = '-1 years',
                $endDate = 'now'),
                'vehicle_reservation_return' => $faker->dateTimeBetween($min = '+ 1 days',
                $endDate = '+ 30 days'),
            ]);

            // Relacion entre ticket y reservation
            $tickets = App\Ticket::where('package_id', $packageId)->get();
            foreach($tickets as $ticket){
                $newTicket = new App\Ticket;
                $newTicket->passenger_id = App\Passenger::all()->random()->id;
                $newTicket->reservation_id = $reservation->id;
                $newTicket->seat_id = $ticket->seat_id;
                $newTicket->package_id = $ticket->package_id;
                $newTicket->seat_letter = $faker->randomLetter;
                $flight = $ticket->flight()->first();
                $newTicket->seat_number = $faker->numberBetween($min=1,
                $max=$flight->flight_capacity);
                $newTicket->flight_id = $flight->id;
                $newTicket->save();
            }
        });
    }
}
