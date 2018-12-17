<?php
use Faker\Generator as Faker;
$factory->define(App\Receipt::class, function (Faker $faker) {
    return [
        'receipt_ammount' => $faker->numberBetween($min = 30000, $max = 120000),
        'receipt_date' => $faker->dateTime($max = 'now', $timezone = null),
        'receipt_type' => $faker->randomElement($array =
          array('boleta', 'factura')),
        'user_id' => App\User::all()->random()->id,
    ];
});
