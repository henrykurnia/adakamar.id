<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Ambil semua kategori + search + pagination
     */
    public function getAll($keyword = null)
    {
        $query = Category::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query
            ->latest()
            ->paginate(10)
            ->appends([
                'keyword' => $keyword
            ]);
    }

    /**
     * Cari kategori berdasarkan ID
     */
    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Simpan kategori baru
     */
    public function create(array $data)
    {
        return Category::create($data);
    }

    /**
     * Update kategori
     */
    public function update($id, array $data)
    {
        $category = $this->findById($id);

        $category->update($data);

        return $category;
    }

    /**
     * Hapus kategori
     */
    public function delete($id)
    {
        $category = $this->findById($id);

        return $category->delete();
    }
}