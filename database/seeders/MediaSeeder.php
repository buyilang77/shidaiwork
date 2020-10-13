<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::insert(
            [
                [
                    'name' => '陕西时代网',
                ],
                [
                    'name' => '荣耀陕西网',
                ],
                [
                    'name' => '陕西政企网',
                ],
                [
                    'name' => '今日头条',
                ],
            ]
        );
    }
}
