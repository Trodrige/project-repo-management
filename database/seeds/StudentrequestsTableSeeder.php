<?php

use Illuminate\Database\Seeder;

class StudentrequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Studentrequest::class, 100)->create();
    }
}
