<?php

namespace Database\Seeders;

use App\Models\ResponsibleEditor;
use Illuminate\Database\Seeder;

class ResponsibleEditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResponsibleEditor::insert(
            [
                [
                    'name' => '张颖',
                    'nickname' => '张颖',
                ],
                [
                    'name' => '朱刚',
                    'nickname' => '朱刚',
                ],
                [
                    'name' => '杨阳',
                    'nickname' => '杨洋',
                ],
                [
                    'name' => '卓西玲',
                    'nickname' => '左悦',
                ],
                [
                    'name' => '刘朋涛',
                    'nickname' => '刘朋涛',
                ],
                [
                    'name' => '杜鹏飞',
                    'nickname' => '杜鹏飞',
                ],
                [
                    'name' => '马瑞琴',
                    'nickname' => '马瑞琴',
                ],
                [
                    'name' => '张金侠',
                    'nickname' => '张金侠',
                ],
                [
                    'name' => '0',
                    'nickname' => '转载',
                ],
            ]
        );
    }
}
