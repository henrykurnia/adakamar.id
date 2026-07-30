<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\StockOpname;
use App\Repositories\Interfaces\ManagerReportRepositoryInterface;

class ManagerReportRepository implements ManagerReportRepositoryInterface
{
    protected Product $product;

    protected StockTransaction $stockTransaction;

    protected StockOpname $stockOpname;

    public function __construct(
        Product $product,
        StockTransaction $stockTransaction,
        StockOpname $stockOpname
    ) {
        $this->product = $product;
        $this->stockTransaction = $stockTransaction;
        $this->stockOpname = $stockOpname;
    }

    /**
     * ==========================================
     * LAPORAN STOK BARANG
     * ==========================================
     */
    public function getStockReport(
        $keyword = null,
        $category = null
    ) {

        $query = $this->product
            ->with([
                'category',
                'supplier'
            ]);

        if (!empty($keyword)) {

            $query->where(function ($q) use ($keyword) {

                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('sku', 'like', "%{$keyword}%");

            });

        }

        if (!empty($category)) {

            $query->where('category_id', $category);

        }

        return $query
            ->orderBy('name')
            ->paginate(10);
    }

    /**
     * ==========================================
     * LAPORAN BARANG MASUK
     * ==========================================
     */
    public function getStockInReport(
        $keyword = null,
        $date = null,
        $month = null,
        $supplier = null,
        $product = null
    ) {

        $query = $this->stockTransaction
            ->with([
                'product',
                'product.category',
                'product.supplier',
                'user'
            ])
            ->where('type', 'Masuk');

        // Search nama produk / SKU
        if (!empty($keyword)) {

            $query->whereHas('product', function ($q) use ($keyword) {

                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('sku', 'like', "%{$keyword}%");

            });

        }

        // Filter tanggal
        if (!empty($date)) {

            $query->whereDate('date', $date);

        }

        // Filter bulan (input type="month")
        if (!empty($month)) {

            $tahun = date('Y', strtotime($month));
            $bulan = date('m', strtotime($month));

            $query->whereYear('date', $tahun)
                ->whereMonth('date', $bulan);

        }

        // Filter supplier
        if (!empty($supplier)) {

            $query->whereHas('product', function ($q) use ($supplier) {

                $q->where('supplier_id', $supplier);

            });

        }

        // Filter produk
        if (!empty($product)) {

            $query->where('product_id', $product);

        }

        return $query
            ->orderByDesc('date')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * ==========================================
     * LAPORAN BARANG KELUAR
     * ==========================================
     */
    public function getStockOutReport(
        $keyword = null,
        $date = null,
        $month = null,
        $supplier = null,
        $product = null
    ) {

        $query = $this->stockTransaction
            ->with([
                'product',
                'product.category',
                'product.supplier',
                'user'
            ])
            ->where('type', 'Keluar');

        // Search nama produk / SKU
        if (!empty($keyword)) {

            $query->whereHas('product', function ($q) use ($keyword) {

                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('sku', 'like', "%{$keyword}%");

            });

        }

        // Filter tanggal
        if (!empty($date)) {

            $query->whereDate('date', $date);

        }

        // Filter bulan (input type="month")
        if (!empty($month)) {

            $tahun = date('Y', strtotime($month));
            $bulan = date('m', strtotime($month));

            $query->whereYear('date', $tahun)
                ->whereMonth('date', $bulan);

        }

        // Filter supplier
        if (!empty($supplier)) {

            $query->whereHas('product', function ($q) use ($supplier) {

                $q->where('supplier_id', $supplier);

            });

        }

        // Filter produk
        if (!empty($product)) {

            $query->where('product_id', $product);

        }

        return $query
            ->orderByDesc('date')
            ->paginate(10)
            ->withQueryString();
    }
    /**
     * ==========================================
     * LAPORAN STOCK OPNAME
     * ==========================================
     */
    public function getStockOpnameReport()
    {
        return $this->stockOpname
            ->with([
                'product',
                'product.category',
                'product.supplier'
            ])
            ->orderByDesc('opname_date')
            ->paginate(10);
    }
}