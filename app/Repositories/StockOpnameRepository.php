<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockOpname;
use App\Repositories\Interfaces\StockOpnameRepositoryInterface;

class StockOpnameRepository implements StockOpnameRepositoryInterface
{
    protected Product $product;
    protected StockOpname $stockOpname;

    public function __construct(
        Product $product,
        StockOpname $stockOpname
    ) {
        $this->product = $product;
        $this->stockOpname = $stockOpname;
    }

    /**
     * Menampilkan seluruh data stock opname
     * + Search berdasarkan nama produk
     * + Pagination
     */
    public function getAll($keyword = null)
    {
        $query = $this->stockOpname
            ->with([
                'product',
                'user'
            ]);

        if (!empty($keyword)) {
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return $query
            ->latest()
            ->paginate(10)
            ->appends([
                'keyword' => $keyword
            ]);
    }

    /**
     * Menampilkan daftar produk
     */
    public function getProducts()
    {
        return $this->product
            ->with([
                'category',
                'supplier'
            ])
            ->orderBy('name')
            ->get();
    }

    /**
     * Simpan stock opname
     */
    public function store(array $data)
    {
        $difference = $data['physical_stock'] - $data['system_stock'];

        return $this->stockOpname->create([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
            'system_stock' => $data['system_stock'],
            'physical_stock' => $data['physical_stock'],
            'difference' => $difference,
            'notes' => $data['notes'] ?? null,
            'opname_date' => $data['date'],
        ]);
    }

    /**
     * Detail stock opname
     */
    public function getById($id)
    {
        return $this->stockOpname
            ->with([
                'product',
                'user'
            ])
            ->findOrFail($id);
    }

    /**
     * Update stock opname
     */
    public function update($id, array $data)
    {
        $stockOpname = $this->stockOpname->findOrFail($id);

        $difference = $data['physical_stock'] - $data['system_stock'];

        $stockOpname->update([
            'user_id' => auth()->id(),
            'system_stock' => $data['system_stock'],
            'physical_stock' => $data['physical_stock'],
            'difference' => $difference,
            'notes' => $data['notes'] ?? null,
            'opname_date' => $data['date'],
        ]);

        return $stockOpname;
    }

    /**
     * Hapus stock opname
     */
    public function delete($id)
    {
        $stockOpname = $this->stockOpname->findOrFail($id);

        return $stockOpname->delete();
    }
}