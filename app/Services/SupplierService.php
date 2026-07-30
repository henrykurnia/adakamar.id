<?php

namespace App\Services;

use App\Repositories\Interfaces\SupplierRepositoryInterface;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Ambil semua supplier + search + pagination
     */
    public function getAllSuppliers($keyword = null)
    {
        return $this->supplierRepository->getAll($keyword);
    }

    /**
     * Ambil supplier berdasarkan ID
     */
    public function getSupplierById($id)
    {
        return $this->supplierRepository->findById($id);
    }

    /**
     * Simpan supplier baru
     */
    public function createSupplier(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    /**
     * Update supplier
     */
    public function updateSupplier($id, array $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    /**
     * Hapus supplier
     */
    public function deleteSupplier($id)
    {
        return $this->supplierRepository->delete($id);
    }
}