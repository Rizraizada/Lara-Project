<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersInvolvedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers_involveds', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('trainers_involveds');
    }
}
