<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    /**
     * Ambil semua supplier + search + pagination
     */
    public function getAll($keyword = null)
    {
        $query = Supplier::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query
            ->latest()
            ->paginate(7)
            ->appends([
                'keyword' => $keyword
            ]);
    }

    /**
     * Cari supplier berdasarkan ID
     */
    public function findById($id)
    {
        return Supplier::findOrFail($id);
    }

    /**
     * Simpan supplier baru
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
        $supplier = Supplier::findOrFail($id);

        return $supplier->delete();
    }
}