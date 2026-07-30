<?php

namespace App\Services;

use App\Repositories\Interfaces\AdminDashboardRepositoryInterface;

class AdminDashboardService
{
    protected $adminDashboardRepository;

    public function __construct(
        AdminDashboardRepositoryInterface $adminDashboardRepository
    ) {
        $this->adminDashboardRepository = $adminDashboardRepository;
    }

    /**
     * Jumlah produk
     */
    public function getTotalProducts()
    {
        return $this->adminDashboardRepository
            ->getTotalProducts();
    }

    /**
     * Total barang masuk
     */
    public function getTotalStockIn($date = null)
    {
        return $this->adminDashboardRepository
            ->getTotalStockIn($date);
    }

    /**
     * Total barang keluar
     */
    public function getTotalStockOut($date = null)
    {
        return $this->adminDashboardRepository
            ->getTotalStockOut($date);
    }

    /**
     * Grafik stok
     */
    public function getStockChart()
    {
        return $this->adminDashboardRepository
            ->getStockChart();
    }

    /**
     * Aktivitas terbaru
     */
    public function getLatestActivities()
    {
        return $this->adminDashboardRepository
            ->getLatestActivities();
    }
}