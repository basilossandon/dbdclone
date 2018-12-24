<?php
use Faker\Generator as Faker;
$factory->define(App\Airport::class, function (Faker $faker) {
    return [
       	'airport_name' => $faker->unique()->word,
       	'airport_code' => strtoupper($faker->lexify('???')),
      	'airport_address' => $faker->unique()->address,
		'city_id' => App\City::all()->random()->id,
    ];
});
