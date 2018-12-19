<?php
use Faker\Generator as Faker;
$factory->define(App\Reservation::class, function (Faker $faker) {
    return [
        'reservation_date' => $faker->dateTime($max = 'now', $timezone = null),
        'reservation_ip' => $faker->ipv4
    ];
});
