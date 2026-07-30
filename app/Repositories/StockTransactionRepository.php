<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Repositories\Interfaces\StockTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class StockTransactionRepository implements StockTransactionRepositoryInterface
{
    /**
     * Daftar transaksi + search nama produk + pagination
     */
    public function getAll($keyword = null)
    {
        $query = StockTransaction::with([
            'product:id,name,sku',
            'user:id,name'
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
     * Detail transaksi
     */
    public function findById($id)
    {
        return StockTransaction::with([
            'product:id,name,sku',
            'user:id,name'
        ])->findOrFail($id);
    }

    /**
     * Tambah transaksi
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            if (
                $data['type'] === 'Keluar' &&
                $data['status'] === 'Dikeluarkan'
            ) {

                $product = Product::lockForUpdate()
                    ->findOrFail($data['product_id']);

                if ($product->stock < $data['quantity']) {
                    throw new Exception('Stok produk tidak mencukupi.');
                }
            }

            $transaction = StockTransaction::create($data);

            $this->recalculateStock($data['product_id']);

            return $transaction;
        });
    }

    /**
     * Update transaksi
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $transaction = StockTransaction::findOrFail($id);

            $oldProductId = $transaction->product_id;

            $transaction->update($data);

            if (
                $data['type'] === 'Keluar' &&
                $data['status'] === 'Dikeluarkan'
            ) {

                $product = Product::findOrFail($data['product_id']);

                $this->recalculateStock($data['product_id']);

                $product->refresh();

                if ($product->stock < 0) {
                    throw new Exception('Stok produk tidak mencukupi.');
                }

            } else {

                $this->recalculateStock($data['product_id']);
            }

            if ($oldProductId != $data['product_id']) {
                $this->recalculateStock($oldProductId);
            }

            return $transaction;
        });
    }

    /**
     * Hapus transaksi
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $transaction = StockTransaction::findOrFail($id);

            $productId = $transaction->product_id;

            $transaction->delete();

            $this->recalculateStock($productId);

            return true;
        });
    }

    /**
     * Hitung ulang stok berdasarkan transaksi valid
     */
    private function recalculateStock($productId)
    {
        $stockMasuk = StockTransaction::where('product_id', $productId)
            ->where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->sum('quantity');

        $stockKeluar = StockTransaction::where('product_id', $productId)
            ->where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->sum('quantity');

        $stock = $stockMasuk - $stockKeluar;

        if ($stock < 0) {
            throw new Exception('Stok produk menjadi negatif.');
        }

        Product::where('id', $productId)->update([
            'stock' => $stock
        ]);
    }
}