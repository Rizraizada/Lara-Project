<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placed_jobs', function (Blueprint $table) {
     
            $table->increments('id');
            $table->string('Courses_offered');
            $table->string('Level_skills');
            $table->string('job_placement');
            $table->string('male');
            $table->string('female');
            $table->string('total');
            $table->string('job_placement_2nd');
            $table->string('male2');
            $table->string('female2');
            $table->string('total2');
            $table->string('cummulative_achived');
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
        Schema::dropIfExists('placed_jobs');
    }
}
