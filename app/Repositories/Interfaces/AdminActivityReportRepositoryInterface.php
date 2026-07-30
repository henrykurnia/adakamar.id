<?php

namespace App\Repositories\Interfaces;

interface AdminActivityReportRepositoryInterface
{
    /**
     * Ambil data aktivitas user
     *
     * @param string|null $date
     * @param string|null $keyword  Search nama user
     * @param string|null $role     Filter role
     * @param string|null $activity Filter aktivitas
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActivities(
        $date = null,
        $keyword = null,
        $role = null,
        $activity = null
    );

    /**
     * Ambil daftar user untuk filter
     */
    public function getUsers();
}