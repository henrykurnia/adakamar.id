<?php

namespace App\Repositories\Interfaces;

interface SupplierRepositoryInterface
{
    /**
     * Ambil semua supplier (search + pagination)
     */
    public function getAll($keyword = null);

    /**
     * Cari supplier berdasarkan ID
     */
    public function findById($id);

    /**
     * Simpan supplier baru
     */
    public function create(array $data);

    /**
     * Update supplier
     */
    public function update($id, array $data);

    /**
     * Hapus supplier
     */
    public function delete($id);
}