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
        Schema::create('task_attachements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('task_id');
            $table->integer('task_meta_id');
            $table->string('task_attachment_url');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_attachements');
    }
};
