<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $products = $this->productService->getProducts($keyword);

        return view(
            'example.content.layouts.stacked',
            compact('products', 'keyword')
        );
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view(
            'example.content.layouts.add_products',
            compact('categories', 'suppliers')
        );
    }

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
            'image' => 'nullable|image|max:800'
        ]);

        // Jika stok kosong, gunakan default database (0)
        if (!isset($validated['stock']) || $validated['stock'] === null || $validated['stock'] === '') {
            unset($validated['stock']);
        }

        // Jika minimum_stock kosong, gunakan default database (0)
        if (!isset($validated['minimum_stock']) || $validated['minimum_stock'] === null || $validated['minimum_stock'] === '') {
            unset($validated['minimum_stock']);
        }

        if ($request->hasFile('image')) {
            $path = $request
                ->file('image')
                ->store('products', 'public');

            $validated['image'] = $path;
        }

        $this->productService->createProduct($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view(
            'example.content.layouts.upd_products',
            compact(
                'product',
                'categories',
                'suppliers'
            )
        );
    }

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
            'image' => 'nullable|image|max:800'
        ]);

        // Jika stok kosong, jangan update kolom stock
        if (!isset($validated['stock']) || $validated['stock'] === null || $validated['stock'] === '') {
            unset($validated['stock']);
        }

        // Jika minimum_stock kosong, jangan update kolom minimum_stock
        if (!isset($validated['minimum_stock']) || $validated['minimum_stock'] === null || $validated['minimum_stock'] === '') {
            unset($validated['minimum_stock']);
        }

        if ($request->hasFile('image')) {
            $path = $request
                ->file('image')
                ->store('products', 'public');

            $validated['image'] = $path;
        }

        $this->productService->updateProduct($id, $validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}