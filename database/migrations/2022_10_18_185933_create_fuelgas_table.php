<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateFuelgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelgas', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicleId')->nullable();
            $table->integer('driverId')->nullable();
            $table->string('supplierName')->nullable();
            $table->string('fuelType')->nullable();
            $table->string('memoNo')->nullable();
            $table->double('unitRate')->nullable();
            $table->double('totalUnit')->nullable();
            $table->double('totalCost')->nullable();
            $table->timestamp('fuelDate')->nullable();
            $table->integer('verifiedBy')->nullable();
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
        Schema::dropIfExists('fuelgas');
    }
}
