<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleRouteTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_route_times', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id')->nullable();
            $table->timestamp('up_trip_start_time')->nullable();
            $table->timestamp('up_trip_end_time')->nullable();
            $table->timestamp('down_trip_start_time')->nullable();
            $table->timestamp('down_trip_end_time')->nullable();
            $table->string('up_trip_start')->nullable();
            $table->string('up_trip_end')->nullable();
            $table->string('down_trip_start')->nullable();
            $table->string('down_trip_end')->nullable();
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
        Schema::dropIfExists('vehicle_route_times');
    }
}
