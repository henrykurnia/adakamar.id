<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\StockTransactionService;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $service;

    public function __construct(
        StockTransactionService $service
    ) {
        $this->service = $service;
    }

    /**
     * Daftar transaksi + search produk
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $transactions = $this->service->getAll($keyword);

        return view(
            'example.content.crud.stok',
            compact(
                'transactions',
                'keyword'
            )
        );
    }

    /**
     * Form tambah transaksi
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view(
            'example.content.crud.add_stok',
            compact('products')
        );
    }

    /**
     * Simpan transaksi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'product_id' => 'required|exists:products,id',

            'user_id' => 'required|exists:users,id',

            'type' => 'required|in:Masuk,Keluar',

            'quantity' => 'required|integer|min:1',

            'date' => 'required|date',

            'status' => 'required',

            'notes' => 'nullable|string'

        ]);

        $this->service->create($validated);

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $transaction = $this->service->findById($id);

        $products = Product::orderBy('name')->get();

        return view(
            'example.content.crud.upd_stok',
            compact(
                'transaction',
                'products'
            )
        );
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([

            'product_id' => 'required|exists:products,id',

            'user_id' => 'required|exists:users,id',

            'type' => 'required|in:Masuk,Keluar',

            'quantity' => 'required|integer|min:1',

            'date' => 'required|date',

            'status' => 'required',

            'notes' => 'nullable|string'

        ]);

        $this->service->update($id, $validated);

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}