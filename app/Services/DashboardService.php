<?php

namespace App\Services;

use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardService
{
    protected $repository;

    public function __construct(
        DashboardRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getDashboardData()
    {
        return $this->repository->getDashboardData();
    }
}