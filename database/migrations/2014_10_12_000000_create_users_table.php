<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->comment = "The user's first name.";
            $table->string('lastname')->comment = "The user's last name";
            $table->string('phone',15)->unique()->comment = "The user's phone number";
            $table->string('email')->unique()->comment = "The user's email.";
            $table->string('role')->comment = "The user's role, student or superadmin or admin.";
            $table->string('type')->default('default')->comment = "Tell whether the admin account has been validated by superadmin or not";
            $table->string('password')->comment = "The user's password.";
            $table->string('is_admin')->default('invalid')->comment = "Tell whether the admin account has been validated by superadmin or not";

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
