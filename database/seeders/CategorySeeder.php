<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Elektronik',
                'description' => 'Produk elektronik',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Pakaian dan aksesoris',
            ],
            [
                'name' => 'Makanan',
                'description' => 'Produk makanan',
            ],
            [
                'name' => 'Minuman',
                'description' => 'Produk minuman',
            ],
        ]);
    }
}