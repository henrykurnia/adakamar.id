<?php

namespace App\Http\Controllers;

use App\Services\StaffDashboardService;

class StaffDashboardController extends Controller
{
    protected StaffDashboardService $staffDashboardService;

    public function __construct(
        StaffDashboardService $staffDashboardService
    ) {
        $this->staffDashboardService = $staffDashboardService;
    }

    public function index()
    {
        $transactions = $this->staffDashboardService->getPendingTransactions();

        $pendingMasukList = $transactions->where('type', 'Masuk');
        $pendingKeluarList = $transactions->where('type', 'Keluar');

        return view('example_staff.index', [
            'title' => 'Dashboard Staff',
            'pendingMasukList' => $pendingMasukList,
            'pendingKeluarList' => $pendingKeluarList,
            'pendingMasukCount' => $pendingMasukList->count(),
            'pendingKeluarCount' => $pendingKeluarList->count(),
        ]);
    }
}