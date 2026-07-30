<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminDashboardService;

class AdminDashboardController extends Controller
{
    protected $adminDashboardService;

    public function __construct(
        AdminDashboardService $adminDashboardService
    ) {
        $this->adminDashboardService = $adminDashboardService;
    }

    public function index(Request $request)
    {
        $date = $request->date;

        return view('example_admin.index', [
            'title' => 'Dashboard Admin | Stockify',

            'totalProducts' => $this->adminDashboardService->getTotalProducts(),

            'totalStockIn' => $this->adminDashboardService
                ->getTotalStockIn($date),

            'totalStockOut' => $this->adminDashboardService
                ->getTotalStockOut($date),

            'stockChart' => $this->adminDashboardService
                ->getStockChart(),

            'latestActivities' => $this->adminDashboardService
                ->getLatestActivities(),

            'date' => $date
        ]);
    }
}