<?php
use Faker\Generator as Faker;
$factory->define(App\Flight::class, function (Faker $faker) {

    return [
        'flight_departure' => $faker->dateTimeBetween($startDay='+1 days',
        $endDate1='+7 days', $timezone=null),
        'flight_arrival' => $faker->dateTimeBetween($endDate1='+0 days',
        $endDate='+1 days', $timezone=null),
        'flight_assigned_plane' => $faker->numberBetween($min=1, $max=150),
        'flight_distance' => $faker->numberBetween($min=500, $max=3000),
        'flight_capacity' => $faker->numberBetween($min=10, $max=50)*3,
        'flight_code' => $faker->randomElement($array =
          array('LAN', 'DSM', 'LXP', 'ARE', 'LAP', 'LNC', 'LNC', 'LPE')). '' .
          $faker->randomElement($array = array('101', '102', '201', '202',
         '203', '204', '205')),
        'departure_airport_id' => App\Airport::all()->random()->id,
        'arrival_airport_id' => App\Airport::all()->random()->id,

    ];
});
