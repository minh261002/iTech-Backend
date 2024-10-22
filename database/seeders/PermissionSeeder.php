<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('permissions')->insert([
        //     // Module permission
        //     [
        //         'title' => 'Xem module',
        //         'name' => 'viewModule',
        //         'guard_name' => 'admin',
        //         'module_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Thêm module',
        //         'name' => 'createModule',
        //         'guard_name' => 'admin',
        //         'module_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Sửa module',
        //         'name' => 'editModule',
        //         'guard_name' => 'admin',
        //         'module_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Xoá module',
        //         'name' => 'deleteModule',
        //         'guard_name' => 'admin',
        //         'module_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // Permission permission
        //     [
        //         'title' => 'Xem quyền',
        //         'name' => 'viewPermission',
        //         'guard_name' => 'admin',
        //         'module_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Thêm quyền',
        //         'name' => 'createPermission',
        //         'guard_name' => 'admin',
        //         'module_id' => 2,
        //         'created_at' => now(),
        //     ],
        //     [
        //         'title' => 'Sửa quyền',
        //         'name' => 'editPermission',
        //         'guard_name' => 'admin',
        //         'module_id' => 2,
        //         'created_at' => now(),
        //     ],
        //     [
        //         'title' => 'Xoá quyền',
        //         'name' => 'deletePermission',
        //         'guard_name' => 'admin',
        //         'module_id' => 2,
        //         'created_at' => now(),
        //     ],

        //     //Role permission
        //     [
        //         'title' => 'Xem vai trò',
        //         'name' => 'viewRole',
        //         'guard_name' => 'admin',
        //         'module_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Thêm vai trò',
        //         'name' => 'createRole',
        //         'guard_name' => 'admin',
        //         'module_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Sửa vai trò',
        //         'name' => 'editRole',
        //         'guard_name' => 'admin',
        //         'module_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Xoá vai trò',
        //         'name' => 'deleteRole',
        //         'guard_name' => 'admin',
        //         'module_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     //Admin permission
        //     [
        //         ,
        //         'title' => 'Xem admin',
        //         'name' => 'viewAdmin',
        //         'guard_name' => 'admin',
        //         'module_id' => 4,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Thêm admin',
        //         'name' => 'createAdmin',
        //         'guard_name' => 'admin',
        //         'module_id' => 4,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Sửa admin',
        //         'name' => 'editAdmin',
        //         'guard_name' => 'admin',
        //         'module_id' => 4,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Xoá admin',
        //         'name' => 'deleteAdmin',
        //         'guard_name' => 'admin',
        //         'module_id' => 4,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     //Member permissions
        //     [
        //         ,
        //         'title' => 'Xem thành viên',
        //         'name' => 'viewMember',
        //         'guard_name' => 'admin',
        //         'module_id' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Thêm thành viên',
        //         'name' => 'createMember',
        //         'guard_name' => 'admin',
        //         'module_id' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Sửa thành viên',
        //         'name' => 'editMember',
        //         'guard_name' => 'admin',
        //         'module_id' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         ,
        //         'title' => 'Xoá thành viên',
        //         'name' => 'deleteMember',
        //         'guard_name' => 'admin',
        //         'module_id' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        Permission::create([
            'title' => 'Xem module',
            'name' => 'viewModule',
            'guard_name' => 'admin',
            'module_id' => 1,
        ]);

        Permission::create([
            'title' => 'Thêm module',
            'name' => 'createModule',
            'guard_name' => 'admin',
            'module_id' => 1,
        ]);

        Permission::create([
            'title' => 'Sửa module',
            'name' => 'editModule',
            'guard_name' => 'admin',
            'module_id' => 1,
        ]);

        Permission::create([
            'title' => 'Xoá module',
            'name' => 'deleteModule',
            'guard_name' => 'admin',
            'module_id' => 1,
        ]);

        Permission::create([
            'title' => 'Xem quyền',
            'name' => 'viewPermission',
            'guard_name' => 'admin',
            'module_id' => 2,
        ]);

        Permission::create([
            'title' => 'Thêm quyền',
            'name' => 'createPermission',
            'guard_name' => 'admin',
            'module_id' => 2,
        ]);

        Permission::create([
            'title' => 'Sửa quyền',
            'name' => 'editPermission',
            'guard_name' => 'admin',
            'module_id' => 2,
        ]);

        Permission::create([
            'title' => 'Xoá quyền',
            'name' => 'deletePermission',
            'guard_name' => 'admin',
            'module_id' => 2,
        ]);

        Permission::create([
            'title' => 'Xem vai trò',
            'name' => 'viewRole',
            'guard_name' => 'admin',
            'module_id' => 3,
        ]);

        Permission::create([
            'title' => 'Thêm vai trò',
            'name' => 'createRole',
            'guard_name' => 'admin',
            'module_id' => 3,
        ]);

        Permission::create([
            'title' => 'Sửa vai trò',
            'name' => 'editRole',
            'guard_name' => 'admin',
            'module_id' => 3,
        ]);

        Permission::create([
            'title' => 'Xoá vai trò',
            'name' => 'deleteRole',
            'guard_name' => 'admin',
            'module_id' => 3,
        ]);

        Permission::create([
            'title' => 'Xem admin',
            'name' => 'viewAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
        ]);

        Permission::create([
            'title' => 'Thêm admin',
            'name' => 'createAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
        ]);

        Permission::create([
            'title' => 'Sửa admin',
            'name' => 'editAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
        ]);

        Permission::create([
            'title' => 'Xoá admin',
            'name' => 'deleteAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
        ]);

        Permission::create([
            'title' => 'Xem thành viên',
            'name' => 'viewMember',
            'guard_name' => 'admin',
            'module_id' => 5,
        ]);

        Permission::create([
            'title' => 'Thêm thành viên',
            'name' => 'createMember',
            'guard_name' => 'admin',
            'module_id' => 5,
        ]);

        Permission::create([
            'title' => 'Sửa thành viên',
            'name' => 'editMember',
            'guard_name' => 'admin',
            'module_id' => 5,
        ]);

        Permission::create([
            'title' => 'Xoá thành viên',
            'name' => 'deleteMember',
            'guard_name' => 'admin',
            'module_id' => 5,
        ]);

        Permission::create([
            'title' => 'Xem chuyên mục',
            'name' => 'viewPostCatalogue',
            'guard_name' => 'admin',
            'module_id' => 6,
        ]);

        Permission::create([
            'title' => 'Thêm chuyên mục',
            'name' => 'createPostCatalogue',
            'guard_name' => 'admin',
            'module_id' => 6,
        ]);

        Permission::create([
            'title' => 'Sửa chuyên mục',
            'name' => 'editPostCatalogue',
            'guard_name' => 'admin',
            'module_id' => 6,
        ]);

        Permission::create([
            'title' => 'Xoá chuyên mục',
            'name' => 'deletePostCatalogue',
            'guard_name' => 'admin',
            'module_id' => 6,
        ]);

        Permission::create([
            'title' => 'Xem bài viết',
            'name' => 'viewPost',
            'guard_name' => 'admin',
            'module_id' => 7,
        ]);

        Permission::create([
            'title' => 'Thêm bài viết',
            'name' => 'createPost',
            'guard_name' => 'admin',
            'module_id' => 7,
        ]);

        Permission::create([
            'title' => 'Sửa bài viết',
            'name' => 'editPost',
            'guard_name' => 'admin',
            'module_id' => 7,
        ]);

        Permission::create([
            'title' => 'Xoá bài viết',
            'name' => 'deletePost',
            'guard_name' => 'admin',
            'module_id' => 7,
        ]);

        Permission::create([
            'title' => 'Xem danh mục',
            'name' => 'viewCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
        ]);

        Permission::create([
            'title' => 'Thêm danh mục',
            'name' => 'createCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
        ]);

        Permission::create([
            'title' => 'Sửa danh mục',
            'name' => 'editCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
        ]);

        Permission::create([
            'title' => 'Xoá danh mục',
            'name' => 'deleteCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
        ]);
    }
}