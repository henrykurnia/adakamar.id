<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccommodationCategoryController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BannerController;



/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landingpage.index');
})->name('home');

Route::get('/kamar', function () {
    return view('landingpage.content.accomodation.kamar');
})->name('kamar');

Route::get('/villa', function () {
    return view('landingpage.content.accomodation.villa');
})->name('villa');

Route::get('/guesthouse', function () {
    return view('landingpage.content.accomodation.guesthouse');
})->name('guesthouse');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.process');

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('example.dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Kategori Akomodasi
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/accommodation-categories',
        [AccommodationCategoryController::class, 'index']
    )->name('accommodation-categories.index');

    Route::post(
        '/accommodation-categories',
        [AccommodationCategoryController::class, 'store']
    )->name('accommodation-categories.store');

    Route::get(
        '/accommodation-categories/{accommodationCategory}/edit',
        [AccommodationCategoryController::class, 'edit']
    )->name('accommodation-categories.edit');

    Route::put(
        '/accommodation-categories/{accommodationCategory}',
        [AccommodationCategoryController::class, 'update']
    )->name('accommodation-categories.update');

    Route::delete(
        '/accommodation-categories/{accommodationCategory}',
        [AccommodationCategoryController::class, 'destroy']
    )->name('accommodation-categories.destroy');


    /*
    |--------------------------------------------------------------------------
    | Aturan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/rules',
        [RuleController::class, 'index']
    )->name('rules.index');

    Route::post(
        '/rules',
        [RuleController::class, 'store']
    )->name('rules.store');

    Route::get(
        '/rules/{rule}/edit',
        [RuleController::class, 'edit']
    )->name('rules.edit');

    Route::put(
        '/rules/{rule}',
        [RuleController::class, 'update']
    )->name('rules.update');

    Route::delete(
        '/rules/{rule}',
        [RuleController::class, 'destroy']
    )->name('rules.destroy');


    /*
    |--------------------------------------------------------------------------
    | Fasilitas
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/facilities',
        [FacilityController::class, 'index']
    )->name('facilities.index');

    Route::post(
        '/facilities',
        [FacilityController::class, 'store']
    )->name('facilities.store');

    Route::get(
        '/facilities/{facility}/edit',
        [FacilityController::class, 'edit']
    )->name('facilities.edit');

    Route::put(
        '/facilities/{facility}',
        [FacilityController::class, 'update']
    )->name('facilities.update');

    Route::delete(
        '/facilities/{facility}',
        [FacilityController::class, 'destroy']
    )->name('facilities.destroy');


    /*
|--------------------------------------------------------------------------
| Penginapan
|--------------------------------------------------------------------------
*/

    Route::get(
        '/penginapan',
        [AccommodationController::class, 'index']
    )->name('accommodations.index');

    Route::post(
        '/penginapan',
        [AccommodationController::class, 'store']
    )->name('accommodations.store');

    Route::get(
        '/penginapan/{id}',
        [AccommodationController::class, 'show']
    )->name('accommodations.show');

    

    Route::put(
        '/penginapan/{id}',
        [AccommodationController::class, 'update']
    )->name('accommodations.update');

    Route::delete(
        '/penginapan/{id}',
        [AccommodationController::class, 'destroy']
    )->name('accommodations.destroy');


    /*
|--------------------------------------------------------------------------
| Kategori Artikel
|--------------------------------------------------------------------------
*/

    Route::get(
        '/article-categories',
        [ArticleCategoryController::class, 'index']
    )->name('article-categories.index');

    Route::post(
        '/article-categories',
        [ArticleCategoryController::class, 'store']
    )->name('article-categories.store');

    Route::get(
        '/article-categories/{id}/edit',
        [ArticleCategoryController::class, 'edit']
    )->name('article-categories.edit');

    Route::put(
        '/article-categories/{id}',
        [ArticleCategoryController::class, 'update']
    )->name('article-categories.update');

    Route::delete(
        '/article-categories/{id}',
        [ArticleCategoryController::class, 'destroy']
    )->name('article-categories.destroy');


    /*
|--------------------------------------------------------------------------
| Artikel
|--------------------------------------------------------------------------
*/

    Route::get(
        '/admin/artikel',
        [ArticleController::class, 'index']
    )->name('articles.index');

    Route::post(
        '/admin/artikel',
        [ArticleController::class, 'store']
    )->name('articles.store');

    Route::get(
        '/admin/artikel/{id}',
        [ArticleController::class, 'show']
    )->name('articles.show');

    Route::get(
        '/admin/artikel/{id}/edit',
        [ArticleController::class, 'edit']
    )->name('articles.edit');

    Route::put(
        '/admin/artikel/{id}',
        [ArticleController::class, 'update']
    )->name('articles.update');

    Route::delete(
        '/admin/artikel/{id}',
        [ArticleController::class, 'destroy']
    )->name('articles.destroy');

/*
|--------------------------------------------------------------------------
| Galeri
|--------------------------------------------------------------------------
*/

Route::get(
    '/galeri',
    [GalleryController::class, 'index']
)->name('galleries.index');

Route::post(
    '/galeri',
    [GalleryController::class, 'store']
)->name('galleries.store');

Route::get(
    '/galeri/{id}',
    [GalleryController::class, 'show']
)->name('galleries.show');

Route::get(
    '/galeri/{id}/edit',
    [GalleryController::class, 'edit']
)->name('galleries.edit');

Route::put(
    '/galeri/{id}',
    [GalleryController::class, 'update']
)->name('galleries.update');

Route::delete(
    '/galeri/{id}',
    [GalleryController::class, 'destroy']
)->name('galleries.destroy');



/*
|--------------------------------------------------------------------------
| Banner
|--------------------------------------------------------------------------
*/ 

Route::get(
    '/banners',
    [BannerController::class, 'index']
)->name('banners.index');

Route::post(
    '/banners',
    [BannerController::class, 'store']
)->name('banners.store');

Route::get(
    '/banners/{id}/edit',
    [BannerController::class, 'edit']
)->name('banners.edit');

Route::put(
    '/banners/{id}',
    [BannerController::class, 'update']
)->name('banners.update');

Route::delete(
    '/banners/{id}',
    [BannerController::class, 'destroy']
)->name('banners.destroy');



});