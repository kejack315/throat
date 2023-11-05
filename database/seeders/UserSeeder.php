<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $seedUsers = [
            [
                'name' => 'Ad Ministrator',
                'email' => 'ad.ministrator@example.com',
                'password' => 'Password1',
                'roles' => ['admin', 'member', 'staff'],
            ],
            [
                'name' => 'STUDENT_GIVEN_NAME',
                'email' => 'STUDENT_GIVEN_NAME@example.com',
                'email_verified_at' => now(),
                'password' => 'Secret1',
                'roles' => ['admin', 'staff', 'member'],
            ],
            [
                'name' => 'Annie Wun',
                'email' => 'annie.wun@example.com',
                'password' => 'Password1',
                'roles' => ['member'],
            ],
            [
                'name' => 'Andy Mann',
                'email' => 'andy.mann@example.com',
                'password' => 'Password1',
                'roles' => ['staff', 'member'],
            ],

            [
                'name' => 'A',
                'email' => '1@1.com',
                'password' => '111111',
                'roles' => ['admin', 'member'],
            ],

            [
                'name' => 'B',
                'email' => '2@2.com',
                'password' => '111111',
                'roles' => ['registered', 'member'],
            ],
        ];

        foreach ($seedUsers as $newUser) {
            $newUser['password'] = Hash::make($newUser['password']);
            $user = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => $newUser['password'],
            ]);
            foreach ($newUser['roles'] as $roleName) {
                $role = Role::firstOrCreate(['name' => $roleName]);  // 如果角色不存在，则创建
                $user->assignRole($role);
            }

        }


    }
}
