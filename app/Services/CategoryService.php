<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Ambil semua kategori + search + pagination
     */
    public function getAllCategories($keyword = null)
    {
        return $this->categoryRepository->getAll($keyword);
    }

    /**
     * Ambil kategori berdasarkan ID
     */
    public function getCategoryById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Simpan kategori baru
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Update kategori
     */
    public function updateCategory($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Hapus kategori
     */
    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }
}