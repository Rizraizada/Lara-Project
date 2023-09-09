<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {

            $table->string('licence_no')->nullable();
            $table->string('model_no')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('yr_of_manufact')->nullable();
            $table->timestamp('date_of_purchase')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
}
