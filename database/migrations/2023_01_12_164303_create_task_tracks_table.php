<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_tracks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('start_time',0);
            $table->dateTime('end_time',0)->nullable();
            $table->integer('task_id');
            $table->integer('task_meta_id_start');
            $table->integer('task_meta_id_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_tracks');
    }
};
