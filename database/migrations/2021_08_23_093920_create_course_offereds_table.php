<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfferedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_offereds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Courses_offered');
            $table->string('training_type');
            $table->string('duration');
            $table->string('training_target');
            $table->string('male');
            $table->string('female');
            $table->string('total');
      
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
        Schema::dropIfExists('course_offereds');
    }
}
