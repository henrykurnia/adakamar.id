<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Repositories\Interfaces\AdminDashboardRepositoryInterface;

class AdminDashboardRepository implements AdminDashboardRepositoryInterface
{
    protected Product $product;
    protected StockTransaction $stockTransaction;

    public function __construct(
        Product $product,
        StockTransaction $stockTransaction
    ) {
        $this->product = $product;
        $this->stockTransaction = $stockTransaction;
    }

    /**
     * Jumlah seluruh produk
     */
    public function getTotalProducts()
    {
        return $this->product->count();
    }

    /**
     * Total barang masuk
     */
    public function getTotalStockIn($date = null)
    {
        return $this->stockTransaction
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->where('type', 'Masuk')
            ->sum('quantity');
    }

    /**
     * Total barang keluar
     */
    public function getTotalStockOut($date = null)
    {
        return $this->stockTransaction
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->where('type', 'Keluar')
            ->sum('quantity');
    }

    /**
     * Data grafik stok barang
     */
    public function getStockChart()
    {
        return $this->product
            ->orderBy('name')
            ->get([
                'name',
                'stock'
            ]);
    }

    /**
     * Aktivitas pengguna terbaru (2 hari terakhir)
     */
    public function getLatestActivities()
    {
        return $this->stockTransaction
            ->with([
                'user',
                'product'
            ])
            ->where('created_at', '>=', Carbon::now()->subDays(2))
            ->orderByDesc('created_at')
            ->take(10)
            ->get();
    }
}