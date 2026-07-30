<?php

namespace App\Repositories\Interfaces;

interface ManagerReportRepositoryInterface
{
    /**
     * ==========================================
     * Laporan Stok Barang
     * ==========================================
     */
    public function getStockReport(
        $keyword = null,
        $category = null
    );

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
    );

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
    );

    /**
     * ==========================================
     * Laporan Stock Opname
     * ==========================================
     */
    public function getStockOpnameReport();
}