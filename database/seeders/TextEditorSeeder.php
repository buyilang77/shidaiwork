<?php

namespace Database\Seeders;

use App\Models\TextEditor;
use Illuminate\Database\Seeder;

class TextEditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TextEditor::insert(
            [
                [
                    'name' => '张宏文',
                    'nickname' => '张文',
                ],
                [
                    'name' => '刘佳',
                    'nickname' => '刘忻',
                ],
                [
                    'name' => '王玲',
                    'nickname' => '王灵',
                ],
                [
                    'name' => '刘江霞',
                    'nickname' => '江沨',
                ],
                [
                    'name' => '郭武明',
                    'nickname' => '武明',
                ],
            ]
        );
    }
}
