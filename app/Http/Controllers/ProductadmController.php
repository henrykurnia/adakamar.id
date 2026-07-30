<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Services\ProductadmService;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductadmController extends Controller
{
    protected ProductadmService $productService;

    public function __construct(ProductadmService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Daftar Produk + Search + Pagination
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $products = $this->productService->getProducts($keyword);

        return view(
            'example_admin.content.layouts.stacked',
            compact('products', 'keyword')
        );
    }

    /**
     * Form Tambah Produk
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view(
            'example_admin.content.layouts.add_products',
            compact('categories', 'suppliers')
        );
    }

    /**
     * Simpan Produk
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'sku' => 'required|unique:products,sku',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'nullable|integer|min:0',
            'minimum_stock' => 'nullable|numeric',
            'image' => 'nullable|image|max:800',
        ]);

        if (
            !isset($validated['stock']) ||
            $validated['stock'] === null ||
            $validated['stock'] === ''
        ) {
            unset($validated['stock']);
        }

        if (
            !isset($validated['minimum_stock']) ||
            $validated['minimum_stock'] === null ||
            $validated['minimum_stock'] === ''
        ) {
            unset($validated['minimum_stock']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        $this->productService->createProduct($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Form Edit
     */
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view(
            'example_admin.content.layouts.upd_products',
            compact('product', 'categories', 'suppliers')
        );
    }

    /**
     * Update Produk
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'sku' => 'required|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'nullable|integer|min:0',
            'minimum_stock' => 'nullable|numeric',
            'image' => 'nullable|image|max:800',
        ]);

        if (
            !isset($validated['stock']) ||
            $validated['stock'] === null ||
            $validated['stock'] === ''
        ) {
            unset($validated['stock']);
        }

        if (
            !isset($validated['minimum_stock']) ||
            $validated['minimum_stock'] === null ||
            $validated['minimum_stock'] === ''
        ) {
            unset($validated['minimum_stock']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        $this->productService->updateProduct($id, $validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Export Produk
     */
    public function export(Request $request)
    {
        $type = $request->get('type', 'xlsx');

        return Excel::download(
            new ProductsExport,
            'products.' . $type
        );
    }

    /**
     * Import Produk
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(
            new ProductsImport,
            $request->file('file')
        );

        return back()->with(
            'success',
            'Data berhasil diimport.'
        );
    }

    /**
     * Hapus Produk
     */
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}