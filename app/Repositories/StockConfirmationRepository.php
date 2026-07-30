<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Repositories\Interfaces\StockConfirmationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class StockConfirmationRepository implements StockConfirmationRepositoryInterface
{
    /**
     * Menampilkan daftar transaksi dengan filter
     */
    public function getAll(array $filters = [])
    {
        $query = StockTransaction::with([
            'product:id,name,sku,stock',
            'user:id,name'
        ]);

        /**
         * ==========================
         * Search Nama Produk / SKU
         * ==========================
         */
        if (!empty($filters['search'])) {

            $search = $filters['search'];

            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        /**
         * ==========================
         * Filter Status
         * ==========================
         *
         * Default : Pending
         * all     : Semua status
         */

        $status = $filters['status'] ?? 'Pending';

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query
            ->latest()
            ->paginate(10)
            ->appends($filters);
    }

    /**
     * Konfirmasi transaksi
     */
    public function confirm($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {

            $transaction = StockTransaction::lockForUpdate()
                ->findOrFail($id);

            // Sudah diproses
            if ($transaction->status != 'Pending') {
                throw new Exception('Transaksi sudah dikonfirmasi.');
            }

            $product = Product::lockForUpdate()
                ->findOrFail($transaction->product_id);

            /**
             * ==========================
             * Barang Masuk
             * ==========================
             */
            if (
                $transaction->type == 'Masuk' &&
                $status == 'Diterima'
            ) {

                $product->increment(
                    'stock',
                    $transaction->quantity
                );

                $transaction->update([
                    'status' => 'Diterima'
                ]);
            }

            /**
             * ==========================
             * Barang Keluar
             * ==========================
             */ elseif (
                $transaction->type == 'Keluar' &&
                $status == 'Dikeluarkan'
            ) {

                if ($product->stock < $transaction->quantity) {
                    throw new Exception('Stok tidak mencukupi.');
                }

                $product->decrement(
                    'stock',
                    $transaction->quantity
                );

                $transaction->update([
                    'status' => 'Dikeluarkan'
                ]);
            }

            /**
             * ==========================
             * Ditolak
             * ==========================
             */ elseif ($status == 'Ditolak') {

                $transaction->update([
                    'status' => 'Ditolak'
                ]);
            }

            return $transaction;
        });
    }
}