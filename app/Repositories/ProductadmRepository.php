<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\ProductRepositoryadmInterface;

class ProductadmRepository implements ProductRepositoryadmInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Menampilkan semua produk + pencarian nama + pagination
     */
    public function getAllProducts($keyword = null)
    {
        return $this->product
            ->with([
                'category',
                'supplier'
            ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(7)
            ->withQueryString();
    }

    /**
     * Cari produk berdasarkan ID
     */
    public function findById($id)
    {
        return $this->product->findOrFail($id);
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
        $product = $this->findById($id);

        if (
            $product->image &&
            Storage::disk('public')->exists($product->image)
        ) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }
}