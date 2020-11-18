<?php

namespace Database\Seeders;

use App\Models\Medium;
use Illuminate\Database\Seeder;

class MediumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medium::insert(
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
