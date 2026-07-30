<?php

namespace App\Repositories\Interfaces;

interface StockConfirmationRepositoryInterface
{
    /**
     * Menampilkan daftar transaksi dengan filter
     */
    public function getAll(array $filters = []);

    /**
     * Konfirmasi transaksi
     */
    public function confirm($id, $status);
}