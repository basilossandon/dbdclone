<?php
use Faker\Generator as Faker;
$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    return [
        'payment_account_number' => $faker->creditCardNumber,
        'payment_method_name' => $faker->creditCardType,
        'payment_method_type' => $faker->randomElement($array =
          array('debito', 'credito')),
    ];
});
