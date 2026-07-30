<?php

namespace App\Exports;

use App\Services\ManagerReportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $keyword;
    protected $category;

    public function __construct($keyword = null, $category = null)
    {
        $this->keyword = $keyword;
        $this->category = $category;
    }

    public function collection()
    {
        $products = app(ManagerReportService::class)
            ->getStockReport(
                $this->keyword,
                $this->category
            );

        return $products->map(function ($item) {
            return [
                'Nama Produk' => $item->name,
                'Kategori' => $item->category->name ?? '-',
                'Supplier' => $item->supplier->name ?? '-',
                'SKU' => $item->sku,
                'Stok' => $item->stock,
                'Minimum Stok' => $item->minimum_stock,
                'Harga Beli' => $item->purchase_price,
                'Harga Jual' => $item->selling_price,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori',
            'Supplier',
            'SKU',
            'Stok',
            'Minimum Stok',
            'Harga Beli',
            'Harga Jual',
        ];
    }
}