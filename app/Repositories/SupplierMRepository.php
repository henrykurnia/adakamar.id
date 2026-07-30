<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierMRepositoryInterface;

class SupplierMRepository implements SupplierMRepositoryInterface
{
    /**
     * Daftar supplier + search + pagination
     */
    public function getAll($keyword = null)
    {
        $query = Supplier::query();

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
     * Detail supplier
     */
    public function findById($id)
    {
        return Supplier::with('products')->findOrFail($id);
    }

    /**
     * Tambah supplier
     */
    public function create(array $data)
    {
        return Supplier::create($data);
    }

    /**
     * Update supplier
     */
    public function update($id, array $data)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update($data);

        return $supplier;
    }

    /**
     * Hapus supplier
     */
    public function delete($id)
    {
        return Supplier::findOrFail($id)->delete();
    }
}