<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->delete();

        Product::insert([
            [
                'category_id' => 1,
                'supplier_id' => 1,
                'name' => 'Sepatu Running Nike',
                'sku' => 'PRD001',
                'description' => 'Sepatu running warna hitam ukuran 42',
                'purchase_price' => 750000,
                'selling_price' => 900000,
                'image' => 'products/nike.jpg',
                'minimum_stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'supplier_id' => 2,
                'name' => 'Sepatu Adidas',
                'sku' => 'PRD002',
                'description' => 'Sepatu olahraga Adidas',
                'purchase_price' => 700000,
                'selling_price' => 850000,
                'image' => 'products/adidas.jpg',
                'minimum_stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'supplier_id' => 1,
                'name' => 'Tas Eiger',
                'sku' => 'PRD003',
                'description' => 'Tas gunung kapasitas 35L',
                'purchase_price' => 450000,
                'selling_price' => 600000,
                'image' => 'products/eiger.jpg',
                'minimum_stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'supplier_id' => 3,
                'name' => 'Jaket Outdoor',
                'sku' => 'PRD004',
                'description' => 'Jaket waterproof outdoor',
                'purchase_price' => 350000,
                'selling_price' => 500000,
                'image' => 'products/jaket.jpg',
                'minimum_stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'supplier_id' => 2,
                'name' => 'Botol Minum Stainless',
                'sku' => 'PRD005',
                'description' => 'Botol minum stainless steel 1 Liter',
                'purchase_price' => 80000,
                'selling_price' => 120000,
                'image' => 'products/botol.jpg',
                'minimum_stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}