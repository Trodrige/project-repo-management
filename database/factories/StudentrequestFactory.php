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

$factory->define(App\Studentrequest::class, function (Faker $faker) {

    $statuses = array('pending','approved');

    $student_ids = App\User::where('role', 'student')->pluck('id')->toArray();
    $project_ids = App\Project::all()->pluck('id')->toArray();

    return [
        'status' => $faker->randomElement($statuses),
        'student_id' => $faker->randomElement($student_ids),
        'project_id' => $faker->randomElement($project_ids),
    ];
});
