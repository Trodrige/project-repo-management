<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('pending')->comment = "whether request has been granted or not";
            $table->integer('student_id')->unsigned()->comment = "The student who wants to work on this project.";
            $table->integer('project_id')->unsigned()->comment = "The project the student wants to work on.";

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

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
        Schema::dropIfExists('requests');
    }
}
