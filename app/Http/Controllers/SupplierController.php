<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * List Supplier + Search + Pagination
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $suppliers = $this->supplierService->getAllSuppliers($keyword);

        return view(
            'example_admin.content.layouts.supplier',
            compact('suppliers', 'keyword')
        );
    }

    /**
     * Form tambah supplier
     */
    public function create()
    {
        return view(
            'example_admin.content.layouts.add_supplier'
        );
    }

    /**
     * Simpan supplier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $this->supplierService->createSupplier($validated);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Form edit supplier
     */
    public function edit($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);

        return view(
            'example_admin.content.layouts.upd_supplier',
            compact('supplier')
        );
    }

    /**
     * Update supplier
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $this->supplierService->updateSupplier($id, $validated);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Hapus supplier
     */
    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}