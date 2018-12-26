<?php

use Faker\Generator as Faker;

$factory->define(App\Hotel::class, function (Faker $faker) {
    return [
        'hotel_name' => $faker->unique()->word,
        'hotel_address' => $faker->unique()->address,
        'hotel_stars' => $faker->numberBetween($min=0, $max=5),
        'city_id' => App\City::all()->random()->id,
    ];
});
