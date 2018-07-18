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

$factory->define(App\Comment::class, function (Faker $faker) {

    $user_ids = App\User::all()->pluck('id')->toArray();
    $project_ids = App\Project::all()->pluck('id')->toArray();

    return [
        'body' => $faker->text($maxNbChars = 200),
        'user_id' => $faker->randomElement($user_ids),
        'project_id' => $faker->randomElement($project_ids),
    ];
});
