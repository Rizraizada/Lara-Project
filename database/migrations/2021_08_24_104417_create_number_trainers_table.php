<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skills_areas');
            $table->string('training_title');
            $table->string('duration');
            $table->string('participants');
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
        Schema::dropIfExists('number_trainers');
    }
}
