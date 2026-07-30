<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Ambil semua produk + search + pagination
     */
    public function getAllProducts($keyword = null)
    {
        $query = $this->product
            ->with([
                'category',
                'supplier'
            ]);

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
     * Detail produk
     */
    public function findById($id)
    {
        return $this->product
            ->findOrFail($id);
    }

    /**
     * Tambah produk
     */
    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        return $this->product->create($data);
    }

    /**
     * Update produk
     */
    public function update($id, array $data)
    {
        $product = $this->findById($id);

        $data['user_id'] = auth()->id();

        $product->update($data);

        return $product;
    }

    /**
     * Hapus produk
     */
    public function delete(int $id)
    {
        $product = $this->product->findOrFail($id);

        if (
            $product->image &&
            Storage::disk('public')->exists($product->image)
        ) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }
}