<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleroutemapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicleroutemaps', function (Blueprint $table) {
            $table->id();

            $table->integer('vehicle_id')->nullable();
            $table->integer('vehicle_driver_id')->nullable();
            $table->string('username')->nullable();
            $table->string('user_desc')->nullable();
            $table->timestamp('period_from')->nullable();
            $table->timestamp('period_to')->nullable();

            $table->integer('prosthan')->nullable();
            $table->integer('agomon')->nullable();

           $table->integer('meterriding')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('vehicleroutemaps');
    }
}
