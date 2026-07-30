<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Product::with(['category', 'supplier'])
            ->get()
            ->map(function ($product) {
                return [
                    'SKU' => $product->sku,
                    'Nama Produk' => $product->name,
                    'Kategori' => $product->category->name ?? '-',
                    'Supplier' => $product->supplier->name ?? '-',
                    'Harga Beli' => $product->purchase_price,
                    'Harga Jual' => $product->selling_price,
                    'Stok' => $product->stock,
                    'Minimum Stok' => $product->minimum_stock,
                    'Deskripsi' => $product->description,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Nama Produk',
            'Kategori',
            'Supplier',
            'Harga Beli',
            'Harga Jual',
            'Stok',
            'Minimum Stok',
            'Deskripsi',
        ];
    }
}