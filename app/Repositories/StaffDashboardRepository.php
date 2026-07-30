<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use App\Repositories\Interfaces\StaffDashboardRepositoryInterface;

class StaffDashboardRepository implements StaffDashboardRepositoryInterface
{
    public function getPendingTransactions()
    {
        return StockTransaction::with(['product', 'user'])
            ->where('status', 'Pending')
            ->latest('date')
            ->get();
    }
}