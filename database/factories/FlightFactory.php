<?php
use Faker\Generator as Faker;
use Carbon\Carbon;
$factory->define(App\Flight::class, function (Faker $faker) {
    $departure = Carbon::instance($faker->dateTimeBetween($startDate='+1 days',
    $endDate='+9 days', $timezone=null));
    $arrival = Carbon::instance($departure);
    $arrival->addHours($faker->numberBetween($min=1, $max=12));
    $airports = App\Airport::all();
    $departure_airport_id = $airports->random()->id;
    $arrival_airport_id = $airports->random()->id;
    if ($arrival_airport_id == $departure_airport_id){
        if ($departure_airport_id == $airports->count())
            $arrival_airport_id -= 1;
        else {
            $arrival_airport_id += 1;
        }
    }

    return [
        'flight_departure' => $departure,
        'flight_arrival' => $arrival,
        'flight_assigned_plane' => $faker->numberBetween($min=1, $max=150),
        'flight_distance' => $faker->numberBetween($min=500, $max=3000),
        'flight_capacity' => $faker->numberBetween($min=10, $max=50)*3,
        'flight_code' => $faker->randomElement($array =
          array('LAN', 'DSM', 'LXP', 'ARE', 'LAP', 'LNC', 'LNC', 'LPE')). '' .
          $faker->randomElement($array = array('101', '102', '201', '202',
         '203', '204', '205')),
        'departure_airport_id' => $departure_airport_id,
        'arrival_airport_id' => $arrival_airport_id,

    ];
});
