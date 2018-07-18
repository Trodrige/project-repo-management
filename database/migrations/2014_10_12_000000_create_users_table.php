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
            $table->string('firstname', 255)->comment = "The user's firstname.";
            $table->string('lastname', 255)->comment = "The user's lastname.";
            $table->string('email')->unique()->comment = "The user's email.";
            $table->string('password', 255)->comment = "The user's password.";
            $table->string('role', 255)->comment = "The user's role, student, staff or admin.";

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
