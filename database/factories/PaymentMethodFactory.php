<?php
use Faker\Generator as Faker;
$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    return [
        'card_owner' => $faker->name,
        'card_number' => $faker->creditCardNumber,
        'card_expiration_date' => $faker->month() . '-' .$faker->year(),
        'card_security_code' => $faker->randomNumber($nbDigits=3),
    ];
});
