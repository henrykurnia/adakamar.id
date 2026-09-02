<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@adakamar.com',
            'password' => Hash::make('admin123'),
            'photo' => null,
            'last_login' => null,
        ]);
    }
}