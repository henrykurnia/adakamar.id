<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $category = Category::where('name', $row['kategori'])->first();

        $supplier = Supplier::where('name', $row['supplier'])->first();

        return new Product([
            'user_id' => Auth::id(), // belum ada variabelnya sehingga tidak dapat mengimport data
            'sku' => $row['sku'],
            'name' => $row['nama_produk'],
            'category_id' => $category?->id,
            'supplier_id' => $supplier?->id,
            'purchase_price' => $row['harga_beli'],
            'selling_price' => $row['harga_jual'],
            'stock' => $row['stok'],
            'minimum_stock' => $row['minimum_stok'],
            'description' => $row['deskripsi'],
        ]);
    }
}