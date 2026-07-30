<?php

namespace App\Services;

use App\Repositories\Interfaces\AdminActivityReportRepositoryInterface;

class AdminActivityReportService
{
    protected $repository;

    public function __construct(
        AdminActivityReportRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Ambil laporan aktivitas
     */
    public function getActivities(
        $date = null,
        $keyword = null,
        $role = null,
        $activity = null
    ) {
        return $this->repository->getActivities(
            $date,
            $keyword,
            $role,
            $activity
        );
    }

    /**
     * Ambil daftar user
     */
    public function getUsers()
    {
        return $this->repository->getUsers();
    }
}