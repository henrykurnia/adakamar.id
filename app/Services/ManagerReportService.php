<?php

namespace App\Services;

use App\Repositories\Interfaces\ManagerReportRepositoryInterface;

class ManagerReportService
{
    protected $managerReportRepository;

    public function __construct(
        ManagerReportRepositoryInterface $managerReportRepository
    ) {
        $this->managerReportRepository = $managerReportRepository;
    }

    /**
     * ==========================================
     * Laporan Stok Barang
     * ==========================================
     */
    public function getStockReport(
        $keyword = null,
        $category = null
    ) {
        return $this->managerReportRepository
            ->getStockReport(
                $keyword,
                $category
            );
    }

    /**
     * ==========================================
     * Laporan Barang Masuk
     * ==========================================
     */
    public function getStockInReport(
        $keyword = null,
        $date = null,
        $month = null,
        $supplier = null,
        $product = null
    ) {
        return $this->managerReportRepository
            ->getStockInReport(
                $keyword,
                $date,
                $month,
                $supplier,
                $product
            );
    }
    /**
     * ==========================================
     * Laporan Barang Keluar
     * ==========================================
     */
    public function getStockOutReport(
        $keyword = null,
        $date = null,
        $month = null,
        $supplier = null,
        $product = null
    ) {
        return $this->managerReportRepository
            ->getStockOutReport(
                $keyword,
                $date,
                $month,
                $supplier,
                $product
            );
    }

    /**
     * ==========================================
     * Laporan Stock Opname
     * ==========================================
     */
    public function getStockOpnameReport()
    {
        return $this->managerReportRepository
            ->getStockOpnameReport();
    }
}