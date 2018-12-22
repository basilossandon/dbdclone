<?php
use Faker\Generator as Faker;
$factory->define(App\Flight::class, function (Faker $faker) {
    return [
        'flight_departure' => $faker->dateTimeBetween($startDay='-1 days', 
        $endDate='now', $timezone=null),
        'flight_arrival' => $faker->dateTimeBetween($startDay='now' ,
        $endDate='+3 days', $timezone=null),
        'flight_assigned_plane' => $faker->numberBetween($min=1, $max=150),
        'flight_distance' => $faker->numberBetween($min=500, $max=3000),
        'flight_capacity' => $faker->numberBetween($min=35, $max=80),
        'flight_code' => $faker->randomElement($array =
          array('BR', 'CL', 'ZL', 'US', 'FR', 'JP', 'VEN', 'RUS')). '_' .
          $faker->randomElement($array = array('COL', 'PER', 'ARG', 'URU',
         'ESP', 'GER', 'POR')),
    ];
});
