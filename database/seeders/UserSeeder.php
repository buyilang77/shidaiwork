<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'username' => 'zhangjinxia',
                'name'     => '张金侠',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'maruiqin',
                'name'     => '马瑞琴',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'dupengfei',
                'name'     => '杜鹏飞',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'liupengtao',
                'name'     => '刘朋涛',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'zuoyue',
                'name'     => '左悦',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'zhugang',
                'name'     => '朱刚',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'yangyang',
                'name'     => '杨洋',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'zhangying',
                'name'     => '张颖',
                'type'     => 1,
                'roles'    => "[3]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'zhangwen',
                'name'     => '张文',
                'type'     => 2,
                'roles'    => "[4, 5]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'liujia',
                'name'     => '刘佳',
                'type'     => 2,
                'roles'    => "[4]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'wangling',
                'name'     => '王玲',
                'type'     => 2,
                'roles'    => "[4]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'liujiangxia',
                'name'     => '刘江霞',
                'type'     => 2,
                'roles'    => "[4, 6]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'wuming',
                'name'     => '武明',
                'type'     => 2,
                'roles'    => "[4]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
            [
                'username' => 'linxiaolong',
                'name'     => '蔺小龙',
                'type'     => 5,
                'roles'    => "[2]",
                'password' => '$2y$10$frXtNd9lFaVSmWOYZ36GbO5IP47v8tGO3X3nvYfqk/jmBY5ElF/8W',
            ],
        ]);
    }
}
