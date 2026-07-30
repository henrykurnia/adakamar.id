<?php

namespace App\Repositories\Interfaces;

interface StockTransactionRepositoryInterface
{
    /**
     * Menampilkan daftar transaksi + search produk
     */
    public function getAll($keyword = null);

    /**
     * Detail transaksi
     */
    public function findById($id);

    /**
     * Simpan transaksi
     */
    public function create(array $data);

    /**
     * Update transaksi
     */
    public function update($id, array $data);

    /**
     * Hapus transaksi
     */
    public function delete($id);
}