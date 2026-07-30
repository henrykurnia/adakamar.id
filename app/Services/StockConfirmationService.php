<?php

namespace App\Services;

use App\Repositories\Interfaces\StockConfirmationRepositoryInterface;

class StockConfirmationService
{
    protected $repository;

    public function __construct(
        StockConfirmationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Menampilkan transaksi beserta filter
     */
    public function getAll(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    /**
     * Konfirmasi transaksi
     */
    public function confirm($id, $status)
    {
        return $this->repository->confirm($id, $status);
    }
}