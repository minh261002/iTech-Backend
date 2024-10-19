<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'title' => 'Root',
                'name' => 'Root',
                'guard_name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Super Admin',
                'name' => 'SuperAdmin',
                'guard_name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
            ],
            [
                'role_id' => 1,
                'permission_id' => 6,
            ],
            [
                'role_id' => 1,
                'permission_id' => 7,
            ],
            [
                'role_id' => 1,
                'permission_id' => 8,
            ],
            [
                'role_id' => 1,
                'permission_id' => 9,
            ],
            [
                'role_id' => 1,
                'permission_id' => 10,
            ],
            [
                'role_id' => 1,
                'permission_id' => 11,
            ],
            [
                'role_id' => 1,
                'permission_id' => 12,
            ],
            [
                'role_id' => 1,
                'permission_id' => 13,
            ],
            [
                'role_id' => 1,
                'permission_id' => 14,
            ],
            [
                'role_id' => 1,
                'permission_id' => 15,
            ],
            [
                'role_id' => 1,
                'permission_id' => 16,
            ],
            [
                'role_id' => 1,
                'permission_id' => 17,
            ],
            [
                'role_id' => 1,
                'permission_id' => 18,
            ],
            [
                'role_id' => 1,
                'permission_id' => 19,
            ],
            [
                'role_id' => 1,
                'permission_id' => 20,
            ],
            [
                'role_id' => 1,
                'permission_id' => 21,
            ],
            [
                'role_id' => 1,
                'permission_id' => 22,
            ],
            [
                'role_id' => 1,
                'permission_id' => 23,
            ],
            [
                'role_id' => 1,
                'permission_id' => 24,
            ],

            //
            [
                'role_id' => 2,
                'permission_id' => 1,
            ],
            [
                'role_id' => 2,
                'permission_id' => 2,
            ],
            [
                'role_id' => 2,
                'permission_id' => 3,
            ],
            [
                'role_id' => 2,
                'permission_id' => 4,
            ],
            [
                'role_id' => 2,
                'permission_id' => 5,
            ],
            [
                'role_id' => 2,
                'permission_id' => 6,
            ],
            [
                'role_id' => 2,
                'permission_id' => 7,
            ],
            [
                'role_id' => 2,
                'permission_id' => 8,
            ],
            [
                'role_id' => 2,
                'permission_id' => 9,
            ],
            [
                'role_id' => 2,
                'permission_id' => 10,
            ],
            [
                'role_id' => 2,
                'permission_id' => 11,
            ],
            [
                'role_id' => 2,
                'permission_id' => 12,
            ],
            [
                'role_id' => 2,
                'permission_id' => 13,
            ],
            [
                'role_id' => 2,
                'permission_id' => 14,
            ],
            [
                'role_id' => 2,
                'permission_id' => 15,
            ],
            [
                'role_id' => 2,
                'permission_id' => 16,
            ],
            [
                'role_id' => 2,
                'permission_id' => 17,
            ],
            [
                'role_id' => 2,
                'permission_id' => 18,
            ],
            [
                'role_id' => 2,
                'permission_id' => 19,
            ],
            [
                'role_id' => 2,
                'permission_id' => 20,
            ],
            [
                'role_id' => 2,
                'permission_id' => 21,
            ],
            [
                'role_id' => 2,
                'permission_id' => 22,
            ],
            [
                'role_id' => 2,
                'permission_id' => 23,
            ],
            [
                'role_id' => 2,
                'permission_id' => 24,
            ],
        ]);

        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Models\Admin',
                'model_id' => 1,
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\Admin',
                'model_id' => 2,
            ],
        ]);
    }
}