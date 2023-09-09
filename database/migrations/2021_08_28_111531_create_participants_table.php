<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('present_vill');
            $table->string('present_post');
            $table->string('present_post_number');
            $table->string('present_upazilla');
            $table->string('present_district');
            $table->string('permanent_vill')->nullable();
            $table->string('permanent_post')->nullable();
            $table->string('permanent_post_number')->nullable();
            $table->string('permanent_upazilla')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('phone_no');
            $table->string('gender');
            $table->string('country');
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
        Schema::dropIfExists('participants');
    }
}
