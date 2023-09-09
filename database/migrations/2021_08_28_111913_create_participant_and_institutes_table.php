<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantAndInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_and_institutes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_id');
            $table->integer('participant_type'); // 1 for teacher, 2 for student, 3 for employee
            $table->integer('batch_id')->default(0);
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
        Schema::dropIfExists('participant_and_institutes');
    }
}
