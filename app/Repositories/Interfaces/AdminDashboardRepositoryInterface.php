<?php

namespace App\Repositories\Interfaces;

interface AdminDashboardRepositoryInterface
{
    /**
     * Jumlah seluruh produk
     */
    public function getTotalProducts();

    /**
     * Total transaksi barang masuk
     */
    public function getTotalStockIn($date = null);

    /**
     * Total transaksi barang keluar
     */
    public function getTotalStockOut($date = null);

    /**
     * Data grafik stok
     */
    public function getStockChart();

    /**
     * Aktivitas pengguna terbaru
     */
    public function getLatestActivities();
}