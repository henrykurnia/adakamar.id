<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GaleriesController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkomodasiController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::middleware(['guest', PreventBackHistory::class])->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Akomodasi
|--------------------------------------------------------------------------
*/

// GET - tampilkan semua akomodasi
Route::get('/akomodasi', [AkomodasiController::class, 'index'])
    ->name('akomodasi.index');

// GET - form tambah
Route::get('/akomodasi/create', [AkomodasiController::class, 'create'])
    ->name('akomodasi.create');

// POST - simpan data
Route::post('/akomodasi', [AkomodasiController::class, 'store'])
    ->name('akomodasi.store');

// GET - detail
Route::get('/akomodasi/{akomodasi}', [AkomodasiController::class, 'show'])
    ->name('akomodasi.show');

// GET - form edit
Route::get('/akomodasi/{akomodasi}/edit', [AkomodasiController::class, 'edit'])
    ->name('akomodasi.edit');

// PUT - update data
Route::put('/akomodasi/{akomodasi}', [AkomodasiController::class, 'update'])
    ->name('akomodasi.update');

// DELETE - hapus data
Route::delete('/akomodasi/{akomodasi}', [AkomodasiController::class, 'destroy'])
    ->name('akomodasi.destroy');


/*
|--------------------------------------------------------------------------
| Kategori
|--------------------------------------------------------------------------
*/

Route::get('/kategori', [KategoriController::class, 'index'])
    ->name('kategori.index');

Route::get('/kategori/create', [KategoriController::class, 'create'])
    ->name('kategori.create');

Route::post('/kategori', [KategoriController::class, 'store'])
    ->name('kategori.store');

Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])
    ->name('kategori.show');

Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])
    ->name('kategori.edit');

Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])
    ->name('kategori.update');

Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])
    ->name('kategori.destroy');


/*
|--------------------------------------------------------------------------
| Fasilitas
|--------------------------------------------------------------------------
*/

Route::get('/fasilitas', [FasilitasController::class, 'index'])
    ->name('fasilitas.index');

Route::get('/fasilitas/create', [FasilitasController::class, 'create'])
    ->name('fasilitas.create');

Route::post('/fasilitas', [FasilitasController::class, 'store'])
    ->name('fasilitas.store');

Route::get('/fasilitas/{fasilitas}', [FasilitasController::class, 'show'])
    ->name('fasilitas.show');

Route::get('/fasilitas/{fasilitas}/edit', [FasilitasController::class, 'edit'])
    ->name('fasilitas.edit');

Route::put('/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])
    ->name('fasilitas.update');

Route::delete('/fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])
    ->name('fasilitas.destroy');


/*
|--------------------------------------------------------------------------
| Aturan
|--------------------------------------------------------------------------
*/

Route::get('/aturan', [RuleController::class, 'index'])
    ->name('aturan.index');

Route::get('/aturan/create', [RuleController::class, 'create'])
    ->name('aturan.create');

Route::post('/aturan', [RuleController::class, 'store'])
    ->name('aturan.store');

Route::get('/aturan/{aturan}', [RuleController::class, 'show'])
    ->name('aturan.show');

Route::get('/aturan/{aturan}/edit', [RuleController::class, 'edit'])
    ->name('aturan.edit');

Route::put('/aturan/{aturan}', [RuleController::class, 'update'])
    ->name('aturan.update');

Route::delete('/aturan/{aturan}', [RuleController::class, 'destroy'])
    ->name('aturan.destroy');


/*
|--------------------------------------------------------------------------
| Artikel
|--------------------------------------------------------------------------
*/

Route::get('/artikel', [ArticleController::class, 'index'])
    ->name('artikel.index');

Route::get('/artikel/create', [ArticleController::class, 'create'])
    ->name('artikel.create');

Route::post('/artikel', [ArticleController::class, 'store'])
    ->name('artikel.store');

Route::get('/artikel/{artikel}', [ArticleController::class, 'show'])
    ->name('artikel.show');

Route::get('/artikel/{artikel}/edit', [ArticleController::class, 'edit'])
    ->name('artikel.edit');

Route::put('/artikel/{artikel}', [ArticleController::class, 'update'])
    ->name('artikel.update');

Route::delete('/artikel/{artikel}', [ArticleController::class, 'destroy'])
    ->name('artikel.destroy');


Route::get('/artikel_kategori', [ArticleCategoryController::class, 'index'])
    ->name('artikel_kategori.index');

Route::get('/artikel_kategori/create', [ArticleCategoryController::class, 'create'])
    ->name('artikel_kategori.create');

Route::post('/artikel_kategori', [ArticleCategoryController::class, 'store'])
    ->name('artikel_kategori.store');

Route::get('/artikel_kategori/{artikel_kategori}', [ArticleCategoryController::class, 'show'])
    ->name('artikel_kategori.show');

Route::get('/artikel_kategori/{artikel_kategori}/edit', [ArticleCategoryController::class, 'edit'])
    ->name('artikel_kategori.edit');

Route::put('/artikel_kategori/{artikel_kategori}', [ArticleCategoryController::class, 'update'])
    ->name('artikel_kategori.update');

Route::delete('/artikel_kategori/{artikel_kategori}', [ArticleCategoryController::class, 'destroy'])
    ->name('artikel_kategori.destroy');


/*
|--------------------------------------------------------------------------
| Banner
|--------------------------------------------------------------------------
*/

Route::get('/banner', [BannerController::class, 'index'])
    ->name('banner.index');

Route::get('/banner/create', [BannerController::class, 'create'])
    ->name('banner.create');

Route::post('/banner', [BannerController::class, 'store'])
    ->name('banner.store');

Route::get('/banner/{banner}', [BannerController::class, 'show'])
    ->name('banner.show');

Route::get('/banner/{banner}/edit', [BannerController::class, 'edit'])
    ->name('banner.edit');

Route::put('/banner/{banner}', [BannerController::class, 'update'])
    ->name('banner.update');

Route::delete('/banner/{banner}', [BannerController::class, 'destroy'])
    ->name('banner.destroy');


Route::get('/tentang', [SettingController::class, 'index'])
    ->name('tentang.index');

Route::get('/tentang/create', [SettingController::class, 'create'])
    ->name('tentang.create');

Route::post('/tentang', [SettingController::class, 'store'])
    ->name('tentang.store');

Route::get('/tentang/{tentang}', [SettingController::class, 'show'])
    ->name('tentang.show');

Route::get('/tentang/{tentang}/edit', [SettingController::class, 'edit'])
    ->name('tentang.edit');

Route::put('/tentang/{tentang}', [SettingController::class, 'update'])
    ->name('tentang.update');

Route::delete('/tentang/{tentang}', [SettingController::class, 'destroy'])
    ->name('tentang.destroy');

// ========================================
// Galeries Landing Page
// ========================================

Route::get('/galeries', [GaleriesController::class, 'index'])
    ->name('galeries.index');

Route::get('/galeries/create', [GaleriesController::class, 'create'])
    ->name('galeries.create');

Route::post('/galeries', [GaleriesController::class, 'store'])
    ->name('galeries.store');

Route::get('/galeries/{id}/edit', [GaleriesController::class, 'edit'])
    ->name('galeries.edit');

Route::put('/galeries/{id}', [GaleriesController::class, 'update'])
    ->name('galeries.update');

Route::delete('/galeries/{id}', [GaleriesController::class, 'destroy'])
    ->name('galeries.destroy');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::put('/users', [UserController::class, 'update'])
        ->name('users.update');


});