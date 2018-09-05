<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->comment = "The project's title.";
            $table->string('description', 255)->comment = "The project's description.";
            $table->string('type', 255)->comment = "The project's type, internship or final_year_project.";
            $table->string('isvalid')->default('invalid')->comment = "The date this project was validated.";
            $table->string('filename_pdf', 255)->default('123.pdf')->comment = "The filename of the pdf of the project, once it's validated.";
            $table->string('zip_filename', 255)->default('123.zip')->comment = "The filename of the zip file.";
            $table->integer('user_id')->unsigned()->comment = "The user who is the author of this project.";
            //$table->integer('owner_id')->unsigned()->comment = "The user who is the author of this project.";
            //$table->integer('admin_id')->unsigned()->comment = "The staff member(supervisor) responsible for validating this project.";

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('projects');
    }
}
