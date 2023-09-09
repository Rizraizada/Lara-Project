<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive', function (Blueprint $table) {
            $table->id();
            $table->integer('createdby')->nullable();
            $table->integer('arcivetype')->nullable();
            $table->string('file_heading')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('dept_id')->nullable();
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
        Schema::dropIfExists('archive');
    }
}
