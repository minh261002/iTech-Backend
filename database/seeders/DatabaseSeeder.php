<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            ModuleSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            WardSeeder::class,
        ]);
    }
}