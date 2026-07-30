<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        ProductAttribute::insert([

            [
                'product_id' => 1,
                'name' => 'Warna',
                'value' => 'Hitam',
            ],
            [
                'product_id' => 1,
                'name' => 'Ukuran',
                'value' => '42',
            ],

            [
                'product_id' => 2,
                'name' => 'Warna',
                'value' => 'Putih',
            ],

            [
                'product_id' => 3,
                'name' => 'Berat',
                'value' => '500 gr',
            ],

            [
                'product_id' => 4,
                'name' => 'Volume',
                'value' => '600 ml',
            ],
        ]);
    }
}