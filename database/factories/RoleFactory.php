<?php
use Faker\Generator as Faker;
$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'role_name' => $faker->unique()->word(),
        'role_description' => $faker->text(200),
    ];
});