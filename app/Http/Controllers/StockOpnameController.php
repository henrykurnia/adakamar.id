<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StockOpnameService;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;

    public function __construct(StockOpnameService $stockOpnameService)
    {
        $this->stockOpnameService = $stockOpnameService;
    }

    /**
     * Menampilkan daftar stock opname
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $stockOpnames = $this->stockOpnameService->getStockOpnames($keyword);

        if (Auth::user()->role == 'Admin') {
            $view = 'example_admin.content.crud.opname';
        } elseif (Auth::user()->role == 'Staff Gudang') {
            $view = 'example_staff.content.crud.opname';
        } else {
            $view = 'example.content.crud.opname';
        }

        return view(
            $view,
            compact(
                'stockOpnames',
                'keyword'
            )
        );
    }

    /**
     * Form tambah stock opname
     */
    public function create()
    {
        $products = $this->stockOpnameService->getProducts();

        if (Auth::user()->role == 'Admin') {
            $view = 'example_admin.content.crud.add_opname';
        } elseif (Auth::user()->role == 'Staff Gudang') {
            $view = 'example_staff.content.crud.add_opname';
        } else {
            $view = 'example.content.crud.add_opname';
        }

        return view($view, compact('products'));
    }

    /**
     * Simpan stock opname
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'system_stock' => 'required|integer|min:0',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $this->stockOpnameService->createStockOpname($validated);

        if (Auth::user()->role == 'Admin') {
            $route = 'admin.stock-opnames.index';
        } elseif (Auth::user()->role == 'Staff Gudang') {
            $route = 'staff.stock-opnames.index';
        } else {
            $route = 'stock-opnames.index';
        }

        return redirect()
            ->route($route)
            ->with('success', 'Stock opname berhasil ditambahkan.');
    }

    /**
     * Ambil data stock opname untuk modal edit
     */
    public function edit($id)
    {
        $stockOpname = $this->stockOpnameService->getStockOpnameById($id);

        return response()->json($stockOpname);
    }

    /**
     * Update stock opname
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'system_stock' => 'required|integer|min:0',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $this->stockOpnameService->updateStockOpname($id, $validated);

        if (Auth::user()->role == 'Admin') {
            $route = 'admin.stock-opnames.index';
        } elseif (Auth::user()->role == 'Staff Gudang') {
            $route = 'staff.stock-opnames.index';
        } else {
            $route = 'stock-opnames.index';
        }

        return redirect()
            ->route($route)
            ->with('success', 'Stock opname berhasil diperbarui.');
    }

    /**
     * Hapus stock opname
     */
    public function destroy($id)
    {
        $this->stockOpnameService->deleteStockOpname($id);

        if (Auth::user()->role == 'Admin') {
            $route = 'admin.stock-opnames.index';
        } elseif (Auth::user()->role == 'Staff Gudang') {
            $route = 'staff.stock-opnames.index';
        } else {
            $route = 'stock-opnames.index';
        }

        return redirect()
            ->route($route)
            ->with('success', 'Stock opname berhasil dihapus.');
    }
}