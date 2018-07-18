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

    $roles = array('student','staff', 'admin');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => app('hash')->make('yourpassword'), // secret
        'role' => $faker->randomElement($roles),
        'remember_token' => str_random(10),
    ];
});
