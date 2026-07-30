<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Product;
use App\Models\StockOpname;
use App\Models\StockTransaction;
use App\Repositories\Interfaces\AdminActivityReportRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminActivityReportRepository implements AdminActivityReportRepositoryInterface
{
    protected User $user;
    protected Product $product;
    protected StockTransaction $transaction;
    protected StockOpname $opname;

    public function __construct(
        User $user,
        Product $product,
        StockTransaction $transaction,
        StockOpname $opname
    ) {
        $this->user = $user;
        $this->product = $product;
        $this->transaction = $transaction;
        $this->opname = $opname;
    }

    /**
     * Daftar user untuk dropdown
     */
    public function getUsers()
    {
        return $this->user
            ->orderBy('name')
            ->get();
    }

    /**
     * Laporan aktivitas
     */
    public function getActivities(
        $date = null,
        $keyword = null,
        $role = null,
        $activity = null
    ) {
        $activities = collect();

        /*
        |--------------------------------------------------------------------------
        | Produk
        |--------------------------------------------------------------------------
        */

        if (!$activity || $activity == 'Produk') {

            $products = $this->product
                ->with('user')
                ->when($date, function ($q) use ($date) {
                    $q->whereDate('created_at', $date);
                })
                ->when($keyword, function ($q) use ($keyword) {
                    $q->whereHas('user', function ($user) use ($keyword) {
                        $user->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->when($role, function ($q) use ($role) {
                    $q->whereHas('user', function ($user) use ($role) {
                        $user->where('role', $role);
                    });
                })
                ->get()
                ->map(function ($item) {

                    return [
                        'tanggal' => $item->created_at,
                        'user' => $item->user->name,
                        'role' => $item->user->role,
                        'aktivitas' => 'Menambahkan Produk',
                        'keterangan' => $item->name,
                    ];
                });

            $activities = $activities->merge($products);
        }

        /*
        |--------------------------------------------------------------------------
        | Transaksi
        |--------------------------------------------------------------------------
        */

        if (!$activity || $activity == 'Transaksi') {

            $transactions = $this->transaction
                ->with([
                    'user',
                    'product'
                ])
                ->when($date, function ($q) use ($date) {
                    $q->whereDate('date', $date);
                })
                ->when($keyword, function ($q) use ($keyword) {
                    $q->whereHas('user', function ($user) use ($keyword) {
                        $user->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->when($role, function ($q) use ($role) {
                    $q->whereHas('user', function ($user) use ($role) {
                        $user->where('role', $role);
                    });
                })
                ->get()
                ->map(function ($item) {

                    return [
                        'tanggal' => $item->date,
                        'user' => $item->user->name,
                        'role' => $item->user->role,
                        'aktivitas' => 'Transaksi ' . $item->type,
                        'keterangan' => $item->product->name,
                    ];
                });

            $activities = $activities->merge($transactions);
        }

        /*
        |--------------------------------------------------------------------------
        | Stock Opname
        |--------------------------------------------------------------------------
        */

        if (!$activity || $activity == 'Stock Opname') {

            $opnames = $this->opname
                ->with([
                    'user',
                    'product'
                ])
                ->when($date, function ($q) use ($date) {
                    $q->whereDate('opname_date', $date);
                })
                ->when($keyword, function ($q) use ($keyword) {
                    $q->whereHas('user', function ($user) use ($keyword) {
                        $user->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->when($role, function ($q) use ($role) {
                    $q->whereHas('user', function ($user) use ($role) {
                        $user->where('role', $role);
                    });
                })
                ->get()
                ->map(function ($item) {

                    return [
                        'tanggal' => $item->opname_date,
                        'user' => $item->user->name,
                        'role' => $item->user->role,
                        'aktivitas' => 'Stock Opname',
                        'keterangan' => $item->product->name,
                    ];
                });

            $activities = $activities->merge($opnames);
        }

        // Sorting
        $activities = $activities
            ->sortByDesc('tanggal')
            ->values();

        // Pagination manual
        $perPage = 10;
        $page = request()->get('page', 1);

        $items = $activities->slice(
            ($page - 1) * $perPage,
            $perPage
        )->values();

        return new LengthAwarePaginator(
            $items,
            $activities->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }
}