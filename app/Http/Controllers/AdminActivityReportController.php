<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminActivityReportService;

class AdminActivityReportController extends Controller
{
    protected $adminActivityReportService;

    public function __construct(
        AdminActivityReportService $adminActivityReportService
    ) {
        $this->adminActivityReportService = $adminActivityReportService;
    }

    /**
     * Laporan aktivitas pengguna
     */
    public function index(Request $request)
    {
        $date = $request->date;
        $keyword = $request->keyword; // Search nama user
        $role = $request->role;       // Filter role
        $activity = $request->activity;

        $activities = $this->adminActivityReportService
            ->getActivities(
                $date,
                $keyword,
                $role,
                $activity
            );

        $users = $this->adminActivityReportService->getUsers();

        $roles = [
            'Admin',
            'Manajer Gudang',
            'Staff Gudang'
        ];

        return view(
            'example_admin.content.report.activity_report',
            compact(
                'activities',
                'users',
                'roles',
                'date',
                'keyword',
                'role',
                'activity'
            )
        );
    }
}