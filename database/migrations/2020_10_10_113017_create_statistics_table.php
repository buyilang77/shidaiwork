<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('content_id')->index();
            $table->bigInteger('text_editor_id')->default(0);
            $table->bigInteger('responsible_editor_id')->default(0);
            $table->integer('time')->default(0);
            $table->integer('honor')->default(0);
            $table->integer('government')->default(0);
            $table->integer('headline')->default(0);
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
        Schema::dropIfExists('statistics');
    }
}
