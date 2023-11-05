<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run()
    {
        // 根据你的需求定义权限
        $permissions = [
            'roles_browse',
            'roles_search',
            'roles_create',
            'roles_edit',
            'roles_delete',

            'definition_browse',
            'definition_search',
            'definition_create',
            'definition_edit',
            'definition_delete',

            'word_browse',
            'word_search',
            'word_create',
            'word_edit',
            'word_delete',

            'user_browse',
            'user_search',
            'user_create',
            'user_edit',
            'user_delete',

            'rating_browse',
            'rating_search',
            'rating_create',
            'rating_edit',
            'rating_delete',

            'wordType_browse',
            'wordType_search',
            'wordType_create',
            'wordType_edit',
            'wordType_delete',

            'dashboard_browse',
            'dashboard_search',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_delete',

            // ... 根据你的需求添加更多权限

        ];

        // 创建权限
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);  // 如果权限不存在，则创建
        }

        // 创建角色并分配权限
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());  // Admin 有所有权限



        $staff = Role::firstOrCreate(['name' => 'Staff']);
        // 根据你的需求分配给 Staff 的权限
        $staff->givePermissionTo([
            'definition_browse',
            'definition_search',
            'definition_create',
            'definition_edit',
            'definition_delete',

            'word_browse',
            'word_search',
            'word_create',
            'word_edit',

            'user_browse',
            'user_search',
            'user_create',
            'user_edit',

            'rating_browse',
            'rating_search',
            'rating_create',
            'rating_edit',
            'rating_delete', /* ... */]);

        $user = Role::firstOrCreate(['name' => 'User']);
        // 根据你的需求分配给 User 的权限
        $user->givePermissionTo([
            'definition_browse',
            'definition_search',
            'definition_edit',
            'definition_delete',

            'user_browse',
            'user_search',
            'user_edit',
            'user_delete',

            'rating_browse',
            'rating_search',
            'rating_edit',
            'rating_delete', /* ... */]);

        $registered = Role::firstOrCreate(['name' => 'Registered']);
        // 根据你的需求分配给 Staff 的权限
        $registered->givePermissionTo([
            'definition_browse',
            'definition_search',
            'word_browse',
            'word_search',
            /* ... */]);

        $member = Role::firstOrCreate(['name' => 'Member']);
        // 根据你的需求分配给 Staff 的权限
        $member->givePermissionTo([
            'definition_browse',
            'definition_search',
            'word_browse',
            'word_search', /* ... */]);

        $guest = Role::firstOrCreate(['name' => 'Guest']);
        // 根据你的需求分配给 Other 的权限
        $guest->givePermissionTo([
            'definition_browse',
            'definition_search',
            'word_browse',
            'word_search',/* ... */]);
    }

}
