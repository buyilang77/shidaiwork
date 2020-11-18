<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name'        => '系统管理员',
                'role_key'    => 'admin',
                'description' => '超级管理员, 可以访问所有页面.',
            ],
            [
                'name'        => '总编',
                'role_key'    => 'chief_editor',
                'description' => '总编, 可以访问所有页面.',
            ],
            [
                'name'        => '采编',
                'role_key'    => 'text_editor',
                'description' => '超级管理员, 可以访问所有页面.',
            ],
            [
                'name'        => '文编',
                'role_key'    => 'writing_editor',
                'description' => '文编, 仅可以访问给定权限的页面.',
            ],
            [
                'name'        => '高级文编',
                'role_key'    => 'advanced_editor',
                'description' => '高级文编, 仅可以访问给定权限的页面.',
            ],
            [
                'name'        => '行政',
                'role_key'    => 'administrator',
                'description' => '行政, 可以访问给定权限外文编页面.',
            ],
        ]);
    }
}
