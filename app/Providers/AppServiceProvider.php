<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductadmRepository;
use App\Repositories\Interfaces\ProductRepositoryadmInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;   
use App\Repositories\Interfaces\StockTransactionRepositoryInterface;
use App\Repositories\StockTransactionRepository;
use App\Repositories\SupplierMRepository;
use App\Repositories\Interfaces\SupplierMRepositoryInterface;
use App\Repositories\StockConfirmationRepository;
use App\Repositories\Interfaces\StockConfirmationRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Repositories\StockOpnameRepository;
use App\Repositories\Interfaces\StockOpnameRepositoryInterface;
use App\Repositories\ManagerReportRepository;
use App\Repositories\Interfaces\ManagerReportRepositoryInterface;
use App\Repositories\ProfileManagerRepository;
use App\Repositories\Interfaces\ProfileManagerRepositoryInterface;
use App\Repositories\StaffDashboardRepository;
use App\Repositories\Interfaces\StaffDashboardRepositoryInterface;
use App\Repositories\ProfileStaffRepository;
use App\Repositories\Interfaces\ProfileStaffRepositoryInterface;
use App\Repositories\StockHistoryRepository;
use App\Repositories\Interfaces\StockHistoryRepositoryInterface;
use App\Repositories\AdminDashboardRepository;
use App\Repositories\Interfaces\AdminDashboardRepositoryInterface;
use App\Repositories\ProfileAdminRepository;
use App\Repositories\Interfaces\ProfileAdminRepositoryInterface;
use App\Repositories\AdminActivityReportRepository;
use App\Repositories\Interfaces\AdminActivityReportRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ProductRepositoryadmInterface::class,
            ProductadmRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );


        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );


        $this->app->bind(
            StockTransactionRepositoryInterface::class,
            StockTransactionRepository::class
        );

        $this->app->bind(
            SupplierMRepositoryInterface::class,
            SupplierMRepository::class
        );

        $this->app->bind(
            StockConfirmationRepositoryInterface::class,
            StockConfirmationRepository::class
        );

        $this->app->bind(
            DashboardRepositoryInterface::class,
            DashboardRepository::class
        );

        $this->app->bind(
            StockOpnameRepositoryInterface::class,
            StockOpnameRepository::class
        );

        $this->app->bind(
            ManagerReportRepositoryInterface::class,
            ManagerReportRepository::class
        );

        $this->app->bind(
            ProfileManagerRepositoryInterface::class,
            ProfileManagerRepository::class
        );

        $this->app->bind(
            StaffDashboardRepositoryInterface::class,
            StaffDashboardRepository::class
        );

        $this->app->bind(
            ProfileStaffRepositoryInterface::class,
            ProfileStaffRepository::class
        );

        $this->app->bind(
            StockHistoryRepositoryInterface::class,
            StockHistoryRepository::class
        );

        $this->app->bind(
            AdminDashboardRepositoryInterface::class,
            AdminDashboardRepository::class
        );

        $this->app->bind(
            ProfileAdminRepositoryInterface::class,
            ProfileAdminRepository::class
        );

        $this->app->bind(
            AdminActivityReportRepositoryInterface::class,
            AdminActivityReportRepository::class
        );




    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
