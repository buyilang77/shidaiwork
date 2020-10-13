<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('text_editor_id')->default(0)->index();
            $table->bigInteger('responsible_editor_id')->default(0)->index();
            $table->bigInteger('media_id')->default(0)->index();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('article_link')->nullable();
            $table->string('customer')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
