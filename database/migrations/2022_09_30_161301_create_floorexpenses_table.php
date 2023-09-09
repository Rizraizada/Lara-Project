<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorexpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floorexpenses', function (Blueprint $table) {
            $table->id();
            $table->integer('floor_id');
            $table->integer('item_id');
            $table->integer('expense_quantity');
            $table->integer('expense_price');
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
        Schema::dropIfExists('floorexpenses');
    }
}
