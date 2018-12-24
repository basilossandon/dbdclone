<?php
use Faker\Generator as Faker;
$factory->define(App\Room::class, function (Faker $faker) {
    return [
        'room_price' => $faker->numberBetween($min=50000, $max=120000),
        'room_type' => $faker->randomElement($array =
          array('Single', 'Double', 'Triple', 'Quad', 'Queen', 'King'. 'Twin')),
        'room_name' => $faker->unique()->word,
        'package_id' => App\Package::all()->random()->id,
        'hotel_id' => App\Hotel::all()->random()->id,
    ];
});
