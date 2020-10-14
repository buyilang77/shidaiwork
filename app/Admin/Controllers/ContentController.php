<?php

namespace App\Admin\Controllers;

use App\Models\Content;
use App\Models\Media;
use App\Models\ResponsibleEditor;
use App\Models\TextEditor;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;

class ContentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Content());
        $table->model()->orderBy('id', 'desc');

        $table->column('id', __('Id'));
        $table->column('title', __('标题'));
        $table->column('media.name', __('媒体'));
        $table->column('customer', __('客户'));
        $table->column('created_at', __('创建时间'));
        $table->column('responsibleEditor.nickname', __('采编'));
        $table->column('textEditor.nickname', __('文编'));
        $table->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉查看
            $actions->disableView();
            // 双击列表页的某一行，跳转进入编辑页面，删除和查看操作对应`delete`、`view`
            $actions->dblclick('edit');
        });
        // 去掉批量操作
        $table->disableBatchActions();
        return $table;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Content());

        $form->number('media_id', __('媒体'));
        $form->number('text_editor_id', __('Text editor id'));
        $form->number('responsible_editor_id', __('Responsible editor id'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->text('article_link', __('链接'));
        $form->text('customer', __('客户'));
        $form->text('remark', __('要求'));

        return $form;
    }

    public function create(\Encore\Admin\Layout\Content $content)
    {
        $responsible_editors = ResponsibleEditor::all()->toArray();
        $text_editors = TextEditor::all()->toArray();
        $media = Media::all()->toArray();
        return $content
            ->view('admin.content.form', compact(['responsible_editors', 'text_editors', 'media']));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param \Encore\Admin\Layout\Content $content
     *
     * @return \Encore\Admin\Layout\Content
     */
    public function edit($id, \Encore\Admin\Layout\Content $content)
    {
        $article = Content::findOrFail($id);
        $responsible_editors = ResponsibleEditor::all()->toArray();
        $text_editors = TextEditor::all()->toArray();
        $media = Media::all()->toArray();
        $content_data = compact([
            'responsible_editors',
            'text_editors',
            'media',
        ]);
        $item = [
            'id' => $article->id,
            'title' => $article->title,
            'article_link' => $article->article_link,
            'customer' => $article->customer,
            'responsible_editor_id' => $article->responsible_editor_id,
            'text_editor_id' => $article->text_editor_id,
            'medium_id' => $article->media_id,
            'remark' => $article->remark,
            'content' => $article->content,
        ];
        return $content
            ->view('admin.content.form', array_merge($content_data, $item));
    }
}
