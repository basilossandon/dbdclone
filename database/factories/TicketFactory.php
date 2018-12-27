<?php
use Faker\Generator as Faker;
$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        // 'package_id' => App\Package::all()->random()->id,
        'passenger_id' => App\Passenger::all()->random()->id,
        'reservation_id' => App\Reservation::all()->random()->id,
        'seat_id' => App\Seat::all()->random()->id,
        'seat_letter' => $faker->randomLetter,
        'seat_number' => $faker->numberBetween($min=1, $max=60),

    ];
});
