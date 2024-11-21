<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            User::query()->create([
                'name' => "user{$i}",
                'email' => "user{$i}@user{$i}.com",
                'password' => 'qwerty'
            ]);
        }
    }
}
