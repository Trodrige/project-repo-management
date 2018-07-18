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
            $table->date('date_validated')->comment = "The date this project was validated.";
            $table->string('filename_editable', 255)->default('123.txt')->comment = "The filename of the editable file.";
            $table->string('filename_pdf', 255)->default('123.pdf')->comment = "The filename of the pdf of the project, once it's validated.";
            $table->integer('author_id')->unsigned()->comment = "The user who is the author of this project.";
            $table->integer('jury_id')->unsigned()->comment = "The staff member(supervisor) responsible for validating this project.";

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jury_id')->references('id')->on('users')->onDelete('cascade');

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
