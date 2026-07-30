<?php

namespace App\Services;

use App\Repositories\Interfaces\StockOpnameRepositoryInterface;

class StockOpnameService
{
    protected $stockOpnameRepository;

    public function __construct(
        StockOpnameRepositoryInterface $stockOpnameRepository
    ) {
        $this->stockOpnameRepository = $stockOpnameRepository;
    }

    /**
     * Menampilkan seluruh data stock opname
     * + Search nama produk
     * + Pagination
     */
    public function getStockOpnames($keyword = null)
    {
        return $this->stockOpnameRepository->getAll($keyword);
    }

    /**
     * Menampilkan daftar produk
     */
    public function getProducts()
    {
        return $this->stockOpnameRepository->getProducts();
    }

    /**
     * Simpan stock opname
     */
    public function createStockOpname(array $data)
    {
        return $this->stockOpnameRepository->store($data);
    }

    /**
     * Detail stock opname
     */
    public function getStockOpnameById($id)
    {
        return $this->stockOpnameRepository->getById($id);
    }

    /**
     * Update stock opname
     */
    public function updateStockOpname($id, array $data)
    {
        return $this->stockOpnameRepository->update($id, $data);
    }

    /**
     * Hapus stock opname
     */
    public function deleteStockOpname($id)
    {
        return $this->stockOpnameRepository->delete($id);
    }
}