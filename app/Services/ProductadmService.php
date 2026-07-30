<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryadmInterface;

class ProductadmService
{
    protected $productRepository;

    public function __construct(ProductRepositoryadmInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Ambil daftar produk + search + pagination
     */
    public function getProducts($keyword = null)
    {
        return $this->productRepository->getAllProducts($keyword);
    }

    /**
     * Tambah produk
     */
    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    /**
     * Ambil produk berdasarkan ID
     */
    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Update produk
     */
    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    /**
     * Hapus produk
     */
    public function deleteProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }
}