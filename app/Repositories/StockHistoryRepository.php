<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use App\Repositories\Interfaces\StockHistoryRepositoryInterface;

class StockHistoryRepository implements StockHistoryRepositoryInterface
{
    protected $stockTransaction;

    public function __construct(StockTransaction $stockTransaction)
    {
        $this->stockTransaction = $stockTransaction;
    }

    /**
     * Ambil riwayat stok + search + filter tanggal + pagination
     */
    public function getHistory($date = null, $keyword = null)
    {
        $query = $this->stockTransaction
            ->with([
                'product',
                'user'
            ]);

        // Search berdasarkan nama produk
        if (!empty($keyword)) {
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }

        // Filter tanggal
        if (!empty($date)) {
            $query->whereDate('date', $date);
        }

        return $query
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(10)
            ->appends([
                'date' => $date,
                'keyword' => $keyword
            ]);
    }
}