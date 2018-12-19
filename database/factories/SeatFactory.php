<?php
use Faker\Generator as Faker;
$factory->define(App\Seat::class, function (Faker $faker) {
    return [
      'seat_type' => $faker->randomElement($array =
        array('Economy', 'Premium economy', 'Premium business')),
      'price_modifier' => $faker->randomFloat($nbMaxDecimals = 1, $min = 1,
      $max = 1.5)
    ];
});
