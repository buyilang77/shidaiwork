<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowManuscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_manuscripts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('manuscript_id')->index();
            $table->bigInteger('text_editor_id')->default(0)->comment('采编')->index();
            $table->bigInteger('writing_editor_id')->default(0)->comment('文编')->index();
            $table->bigInteger('advanced_editor_id')->default(0)->comment('高级文编')->index();
            $table->tinyInteger('status')->default(0)
                ->comment('稿件状态 0: 待处理, 1: 处理中, 2: 审核中, 3: 未通过, 4: 已完成')->index();
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
        Schema::dropIfExists('workflow_manuscripts');
    }
}
