<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getDashboardData()
    {
        // Total produk
        $totalProducts = Product::count();

        // Total stok seluruh produk
        $totalStock = Product::sum('stock');

        // Produk stok aman
        $safeStock = Product::whereColumn(
            'stock',
            '>=',
            'minimum_stock'
        )->count();

        // Produk stok menipis
        $lowStock = Product::whereColumn(
            'stock',
            '<',
            'minimum_stock'
        )->count();

        // Barang masuk yang sudah diterima
        $barangMasuk = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->count();

        // Barang keluar yang sudah dikeluarkan
        $barangKeluar = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->count();

        // Produk yang stok menipis
        $lowStockProducts = Product::whereColumn(
            'stock',
            '<',
            'minimum_stock'
        )
            ->orderBy('stock')
            ->take(5)
            ->get();

        return [
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'safeStock' => $safeStock,
            'lowStock' => $lowStock,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'lowStockProducts' => $lowStockProducts,
        ];
    }
}