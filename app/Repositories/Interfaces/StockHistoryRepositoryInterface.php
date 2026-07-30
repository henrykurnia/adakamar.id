<?php

namespace App\Repositories\Interfaces;

interface StockHistoryRepositoryInterface
{
    /**
     * Ambil riwayat stok dengan filter tanggal dan pencarian nama produk
     *
     * @param string|null $date
     * @param string|null $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getHistory($date = null, $keyword = null);
}