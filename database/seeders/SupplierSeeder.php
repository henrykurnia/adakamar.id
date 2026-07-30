<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'PT Sumber Makmur',
                'address' => 'Jakarta',
                'phone' => '081234567890',
                'email' => 'supplier1@gmail.com',
            ],
            [
                'name' => 'CV Maju Bersama',
                'address' => 'Bandung',
                'phone' => '081298765432',
                'email' => 'supplier2@gmail.com',
            ],
            [
                'name' => 'PT Nusantara Jaya',
                'address' => 'Surabaya',
                'phone' => '081211112222',
                'email' => 'supplier3@gmail.com',
            ],
        ]);
    }
}