<?php

namespace App\Services;

use App\Repositories\Interfaces\StockHistoryRepositoryInterface;

class StockHistoryService
{
    protected $stockHistoryRepository;

    public function __construct(
        StockHistoryRepositoryInterface $stockHistoryRepository
    ) {
        $this->stockHistoryRepository = $stockHistoryRepository;
    }

    /**
     * Ambil riwayat stok + search + filter tanggal
     */
    public function getHistory($date = null, $keyword = null)
    {
        return $this->stockHistoryRepository
            ->getHistory($date, $keyword);
    }
}