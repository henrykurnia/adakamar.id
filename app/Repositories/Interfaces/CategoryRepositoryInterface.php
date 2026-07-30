<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Ambil semua kategori (search + pagination)
     */
    public function getAll($keyword = null);

    /**
     * Cari kategori berdasarkan ID
     */
    public function findById($id);

    /**
     * Simpan kategori baru
     */
    public function create(array $data);

    /**
     * Update kategori
     */
    public function update($id, array $data);

    /**
     * Hapus kategori
     */
    public function delete($id);
}