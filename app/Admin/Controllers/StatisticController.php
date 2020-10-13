<?php

namespace App\Admin\Controllers;

use App\Models\Content;
use App\Models\Statistic;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Table;
class StatisticController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '统计';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Statistic());
        $table->model()->orderBy('id', 'desc');

//        $table->column('id', __('Id'));
//        $table->column('title', __('标题'));
//        $table->column('media.name', __('媒体'));
//        $table->column('customer', __('客户'));
        $table->column('created_at', __('日期'));
        $table->column('responsibleEditor.name', __('采编'));
        $table->column('textEditor.name', __('文编'));
        $table->disableCreateButton();
        $table->disableFilter();
        $table->disableExport();

        $table->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
        });

// 全部关闭
        $table->disableActions();

        return $table;
    }
}
