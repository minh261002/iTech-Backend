<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            [
                'name' => 'Quản lý module',
                'description' => 'Quản lý module',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản lý quyền',
                'description' => 'Quản lý quyền',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản lý vai trò',
                'description' => 'Quản lý vai trò',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản lý admin',
                'description' => 'Quản lý admin',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản lý thành viên',
                'description' => 'Quản lý thành viên',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản lý chuyên mục',
                'description' => 'Quản lý chuyên mục',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}