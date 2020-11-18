<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscripts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('media_id')->index();
            $table->integer('channel_id')->default(0)->index();
            $table->string('title')->nullable()->index();
            $table->text('content')->nullable();
            $table->string('article_link')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('customer')->nullable()->index();
            $table->json('file_list')->nullable();
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
        Schema::dropIfExists('manuscripts');
    }
}
