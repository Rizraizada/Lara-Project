<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicledriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicledrivers', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id')->nullable();
            $table->integer('vehicle_driver_id')->nullable();
            $table->timestamp('duration_from')->nullable();
            $table->timestamp('duration_to')->nullable();
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
        Schema::dropIfExists('vehicledrivers');
    }
}
