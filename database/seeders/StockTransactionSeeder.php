<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockTransaction;

class StockTransactionSeeder extends Seeder
{
    public function run(): void
    {
        StockTransaction::insert([

            [
                'product_id' => 1,
                'user_id' => 1,
                'type' => 'Masuk',
                'quantity' => 50,
                'date' => now(),
                'status' => 'Diterima',
                'notes' => 'Stok awal',
            ],

            [
                'product_id' => 2,
                'user_id' => 2,
                'type' => 'Masuk',
                'quantity' => 30,
                'date' => now(),
                'status' => 'Diterima',
                'notes' => 'Supplier PT Makmur',
            ],

            [
                'product_id' => 3,
                'user_id' => 2,
                'type' => 'Keluar',
                'quantity' => 5,
                'date' => now(),
                'status' => 'Dikeluarkan',
                'notes' => 'Penjualan',
            ],

            [
                'product_id' => 1,
                'user_id' => 3,
                'type' => 'Keluar',
                'quantity' => 10,
                'date' => now(),
                'status' => 'Pending',
                'notes' => 'Menunggu persetujuan',
            ],

            [
                'product_id' => 4,
                'user_id' => 1,
                'type' => 'Masuk',
                'quantity' => 100,
                'date' => now(),
                'status' => 'Diterima',
                'notes' => 'Restock',
            ],
        ]);
    }
}