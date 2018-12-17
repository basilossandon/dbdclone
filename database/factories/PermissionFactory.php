<?php

use Faker\Generator as Faker;

$factory->define(App\Permission::class, function (Faker $faker) {
    return [
        'permission_name' => $faker->unique()->word,
        'permission_type' => $faker->randomLetter,
    	];
});
