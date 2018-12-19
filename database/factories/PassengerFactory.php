<?php
use Faker\Generator as Faker;
$factory->define(App\Passenger::class, function (Faker $faker) {
    return [
        'doc_country_emission' => $faker->country,
        'doc_number' => $faker->creditCardNumber,
        'doc_type' => $faker->randomLetter,
        'passenger_name' => $faker->name,
    ];
});
