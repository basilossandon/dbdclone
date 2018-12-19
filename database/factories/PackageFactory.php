<?php
use Faker\Generator as Faker;
$factory->define(App\Package::class, function (Faker $faker) {
    return [
      'package_name' => $faker->unique()->word,
      'package_price' => $faker->numberBetween($min=100000, $max=1200000),
      'package_stock' => $faker->numberBetween($min=0, $max=50),
      'package_type' => $faker->randomLetter,
      'vehicle_id' => App\Vehicle::all()->random()->id,
    ];
});
