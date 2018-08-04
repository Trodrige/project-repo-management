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

$factory->define(App\Project::class, function (Faker $faker) {

    $types = array('internship','final_year_project');

    $owner_ids = App\User::where('role', 'student')->pluck('id')->toArray();
    $admin_ids = App\User::where('role', 'admin')->pluck('id')->toArray();

    return [
        'title' => $faker->catchPhrase(),
        'description' => $faker->text($maxNbChars = 200),
        'type' => $faker->randomElement($types),
        'date_validated' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'owner_id' => $faker->randomElement($owner_ids),
        'admin_id' => $faker->randomElement($admin_ids),
    ];
});
