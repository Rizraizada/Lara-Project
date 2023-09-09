<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Courses_offered');
            $table->string('Level_skills');
            $table->string('Training_target');
            $table->string('male');
            $table->string('female');
            $table->string('total');
            $table->string('Training_target_2nd');
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
        Schema::dropIfExists('progress_reports');
    }
}
