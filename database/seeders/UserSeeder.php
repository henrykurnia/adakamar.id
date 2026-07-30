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
            'email' => 'admin@stockify.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'Staff Gudang',
        ]);

        User::create([
            'name' => 'Manajer Gudang',
            'email' => 'manager@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'Manajer Gudang',
        ]);
    }
}