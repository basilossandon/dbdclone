<?php
use Faker\Generator as Faker;
$factory->define(App\Vehicle::class, function (Faker $faker) {
    return [
        'vehicle_price' => $faker->numberBetween($min=50000, $max=120000),
        'vehicle_type' => $faker->randomElement($array =
          array('Sedan', 'Coupe', 'Station', 'Hatchback')),
        'vehicle_licence_plate' => $faker->ean8,
        'city_id' => App\City::all()->random()->id,
    ];
});
