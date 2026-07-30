<?php

namespace App\Services;

use App\Repositories\Interfaces\StaffDashboardRepositoryInterface;

class StaffDashboardService
{
    protected StaffDashboardRepositoryInterface $repository;

    public function __construct(
        StaffDashboardRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getPendingTransactions()
    {
        return $this->repository->getPendingTransactions();
    }
}