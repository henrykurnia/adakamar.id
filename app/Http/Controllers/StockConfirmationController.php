<?php

namespace App\Http\Controllers;

use App\Services\StockConfirmationService;
use Illuminate\Http\Request;

class StockConfirmationController extends Controller
{
    protected $service;

    public function __construct(StockConfirmationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->search,
            'status' => $request->status,
        ];

        $transactions = $this->service->getAll($filters);

        return view(
            'example_staff.content.crud.stok',
            compact('transactions')
        );
    }

    public function confirm(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak,Dikeluarkan'
        ]);

        $this->service->confirm($id, $request->status);

        return redirect()
            ->route('stock-confirmation.index')
            ->with('success', 'Status berhasil dikonfirmasi.');
    }
}