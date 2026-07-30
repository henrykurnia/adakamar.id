<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryadmInterface
{
    /**
     * Ambil semua produk dengan opsi pencarian nama.
     */
    public function getAllProducts($keyword = null);

    /**
     * Simpan produk baru.
     */
    public function create(array $data);

    /**
     * Cari produk berdasarkan ID.
     */
    public function findById($id);

    /**
     * Update produk.
     */
    public function update($id, array $data);

    /**
     * Hapus produk.
     */
    public function delete(int $id);
}