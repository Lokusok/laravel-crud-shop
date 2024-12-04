<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'role' => 'admin'
            ]
        ];

        foreach ($roles as $role) {
            ${$role['role']} = Role::create([
                'name' => $role['role']
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            $user = User::query()->create([
                'name' => "user{$i}",
                'email' => "user{$i}@user{$i}.com",
                'is_verified' => true,
                'password' => 'qwerty',
            ]);

            $user->roles()->attach($admin);
        }
    }
}
