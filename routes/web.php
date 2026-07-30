<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductadmController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\SupplierMController;
use App\Http\Controllers\StockConfirmationController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ManagerReportController;
use App\Http\Controllers\ProfileManagerController;
use App\Http\Controllers\ProfileStaffController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\AdminActivityReportController;



Route::get('/', function () {
    return redirect()->route('sign-in');
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['guest', 'prevent-back-history'])->group(function () {

    Route::get('/sign-in', [AuthController::class, 'showLogin'])
        ->name('sign-in');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Semua User Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Manajer Gudang
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'role:Manajer Gudang', 'prevent-back-history'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    Route::get('/profile', [ProfileManagerController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileManagerController::class, 'update'])
        ->name('profile.update');



    // Produk (Khusus Manager)
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    Route::get('/suppliers', [SupplierMController::class, 'index'])
        ->name('suppliers.index');

    Route::get('/stock-transactions', [StockTransactionController::class, 'index'])
        ->name('stock-transactions.index');

    Route::get('/stock-transactions/create', [StockTransactionController::class, 'create'])
        ->name('stock-transactions.create');

    Route::post('/stock-transactions', [StockTransactionController::class, 'store'])
        ->name('stock-transactions.store');

    Route::get('/stock-transactions/{id}/edit', [StockTransactionController::class, 'edit'])
        ->name('stock-transactions.edit');

    Route::put('/stock-transactions/{id}', [StockTransactionController::class, 'update'])
        ->name('stock-transactions.update');

    Route::delete('/stock-transactions/{id}', [StockTransactionController::class, 'destroy'])
        ->name('stock-transactions.destroy');

    Route::get('/manager/stock-opnames', [StockOpnameController::class, 'index'])
        ->name('stock-opnames.index');

    Route::get('/manager/stock-opnames/create', [StockOpnameController::class, 'create'])
        ->name('stock-opnames.create');

    Route::post('/manager/stock-opnames', [StockOpnameController::class, 'store'])
        ->name('stock-opnames.store');

    Route::get('/manager/stock-opnames/{id}/edit', [StockOpnameController::class, 'edit'])
        ->name('stock-opnames.edit');

    Route::put('/manager/stock-opnames/{id}', [StockOpnameController::class, 'update'])
        ->name('stock-opnames.update');

    Route::delete('/manager/stock-opnames/{id}', [StockOpnameController::class, 'destroy'])
        ->name('stock-opnames.destroy');

    Route::get(
        '/reports/stock',[ManagerReportController::class, 'stockReport'])
    ->name('reports.stock');

    Route::get('/reports/stock-in',[ManagerReportController::class, 'stockInReport'])
    ->name('reports.stock-in');

    Route::get('/reports/stock-out',[ManagerReportController::class, 'stockOutReport'])
    ->name('reports.stock-out');

    Route::get('/reports/stock-opname',[ManagerReportController::class, 'stockOpnameReport'])
    ->name('reports.stock-opname');

    // Laporan Stok Barang
    Route::get('/reports/stock/export', [ManagerReportController::class, 'exportStockReport'])
        ->name('reports.stock.export');

    // Barang Masuk
    Route::get('/reports/stock-in/export', [ManagerReportController::class, 'exportStockInReport'])
        ->name('reports.stock-in.export');

    // Barang Keluar
    Route::get('/reports/stock-out/export', [ManagerReportController::class, 'exportStockOutReport'])
        ->name('reports.stock-out.export');

    // Stock Opname
    Route::get('/reports/stock-opname/export', [ManagerReportController::class, 'exportStockOpnameReport'])
        ->name('reports.stock-opname.export');

});

/*
|--------------------------------------------------------------------------
| Admin Gudang
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin', 'prevent-back-history'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])
            ->name('dashboard.admin');

        Route::get('/profile/admin', [ProfileAdminController::class, 'edit'])
            ->name('admin.profile.edit');

        Route::put('/profile/admin', [ProfileAdminController::class, 'update'])
            ->name('admin.profile.update');

        Route::get('/products', [ProductadmController::class, 'index'])
            ->name('admin.products.index');

        Route::get('/products/create', [ProductadmController::class, 'create'])
            ->name('admin.products.create');

        Route::post('/products', [ProductadmController::class, 'store'])
            ->name('admin.products.store');

        Route::get('/products/{id}/edit', [ProductadmController::class, 'edit'])
            ->name('admin.products.edit');

        Route::put('/products/{id}', [ProductadmController::class, 'update'])
            ->name('admin.products.update');

        Route::delete('/products/{id}', [ProductadmController::class, 'destroy'])
            ->name('admin.products.destroy');

        Route::get('/admin/products/export', [ProductadmController::class, 'export'])
            ->name('admin.products.export');

        Route::post('/admin/products/import', [ProductadmController::class, 'import'])
            ->name('admin.products.import');

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('admin.categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('admin.categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('admin.categories.store');

        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
            ->name('admin.categories.edit');

        Route::put('/categories/{id}', [CategoryController::class, 'update'])
            ->name('admin.categories.update');

        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
            ->name('admin.categories.destroy');


        Route::get('/suppliers', [SupplierController::class, 'index'])
            ->name('admin.suppliers.index');

        Route::get('/suppliers/create', [SupplierController::class, 'create'])
            ->name('admin.suppliers.create');

        Route::post('/suppliers', [SupplierController::class, 'store'])
            ->name('admin.suppliers.store');

        Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit'])
            ->name('admin.suppliers.edit');

        Route::put('/suppliers/{id}', [SupplierController::class, 'update'])
            ->name('admin.suppliers.update');

        Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])
            ->name('admin.suppliers.destroy');

        Route::get('/stock-history', [StockHistoryController::class, 'index'])
            ->name('admin.stock-history.index');

        Route::get('/admin/stock-opnames', [StockOpnameController::class, 'index'])
            ->name('admin.stock-opnames.index');

        Route::get('/admin/stock-opnames/create', [StockOpnameController::class, 'create'])
            ->name('admin.stock-opnames.create');

        Route::post('/admin/stock-opnames', [StockOpnameController::class, 'store'])
            ->name('admin.stock-opnames.store');

        Route::get('/admin/stock-opnames/{id}/edit', [StockOpnameController::class, 'edit'])
            ->name('admin.stock-opnames.edit');

        Route::put('/admin/stock-opnames/{id}', [StockOpnameController::class, 'update'])
            ->name('admin.stock-opnames.update');

        Route::delete('/admin/stock-opnames/{id}', [StockOpnameController::class, 'destroy'])
            ->name('admin.stock-opnames.destroy');



        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('admin.users.store');

        // Mengambil isi modal edit (AJAX)
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        // Update user
        Route::put('/users/{id}', [UserController::class, 'update'])
            ->name('admin.users.update');

        // Hapus user
        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');

        Route::get('/staff/reports/stock', [ManagerReportController::class, 'stockReport'])
            ->name('admin.reports.stock');

        Route::get('/staff/reports/stock-in', [ManagerReportController::class, 'stockInReport'])
            ->name('admin.reports.stock-in');

        Route::get('/staff/reports/stock-out', [ManagerReportController::class, 'stockOutReport'])
            ->name('admin.reports.stock-out');

        Route::get('/staff/reports/stock-opname', [ManagerReportController::class, 'stockOpnameReport'])
            ->name('admin.reports.stock-opname');

        Route::get(
            '/reports/activity',[AdminActivityReportController::class, 'index'])
            ->name('admin.report.activity');

        // Laporan Stok Barang
        Route::get('/admin/reports/stock/export', [ManagerReportController::class, 'exportStockReport'])
            ->name('admin.reports.stock.export');

        // Barang Masuk
        Route::get('/admin/reports/stock-in/export', [ManagerReportController::class, 'exportStockInReport'])
            ->name('admin.reports.stock-in.export');

        // Barang Keluar
        Route::get('/admin/reports/stock-out/export', [ManagerReportController::class, 'exportStockOutReport'])
            ->name('admin.reports.stock-out.export');

        // Stock Opname
        Route::get('/admin/reports/stock-opname/export', [ManagerReportController::class, 'exportStockOpnameReport'])
            ->name('admin.reports.stock-opname.export');

        

        
    });

/*
|--------------------------------------------------------------------------
| Staff Gudang
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Staff Gudang', 'prevent-back-history'])->group(function () {

    Route::get('/dashboard/staff', [StaffDashboardController::class, 'index'])
        ->name('dashboard.staff');

    Route::get('/profile/staff', [ProfileStaffController::class, 'edit'])
        ->name('staff.profile.edit');

    Route::put('/profile/staff', [ProfileStaffController::class, 'update'])
        ->name('staff.profile.update');

    Route::get('/stock-confirmation', [StockConfirmationController::class, 'index'])
        ->name('stock-confirmation.index');

    Route::put('/stock-confirmation/{id}', [StockConfirmationController::class, 'confirm'])
        ->name('stock-confirmation.confirm');


    Route::get('/stock-opnames', [StockOpnameController::class, 'index'])
        ->name('staff.stock-opnames.index');

    Route::get('/stock-opnames/create', [StockOpnameController::class, 'create'])
        ->name('staff.stock-opnames.create');

    Route::post('/stock-opnames', [StockOpnameController::class, 'store'])
        ->name('staff.stock-opnames.store');

    Route::get('/stock-opnames/{id}/edit', [StockOpnameController::class, 'edit'])
        ->name('staff.stock-opnames.edit');

    Route::put('/stock-opnames/{id}', [StockOpnameController::class, 'update'])
        ->name('staff.stock-opnames.update');

    Route::delete('/stock-opnames/{id}', [StockOpnameController::class, 'destroy'])
        ->name('staff.stock-opnames.destroy');



});