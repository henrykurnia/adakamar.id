<?php

namespace App\Services;

use App\Repositories\Interfaces\StockTransactionRepositoryInterface;

class StockTransactionService
{
    protected $repository;

    public function __construct(
        StockTransactionRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Daftar transaksi + search produk
     */
    public function getAll($keyword = null)
    {
        return $this->repository->getAll($keyword);
    }

    /**
     * Detail transaksi
     */
    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Tambah transaksi
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Ambil stok produk
     */
    public function getProductStock($id)
    {
        return $this->repository->getProductStock($id);
    }

    /**
     * Update transaksi
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Hapus transaksi
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}