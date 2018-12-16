<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
        'role_id' => App\Role::all()->random()->id,
        'user_date_of_birth' => $faker->date(),
        'user_points' => $faker->numberBetween(0, 50000),
        'user_phone' => $faker->e164PhoneNumber()
    	];
});
