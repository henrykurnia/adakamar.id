<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\AkomodasiRepositoryInterface;
use App\Repositories\Interfaces\ArticleCategoryRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;
use App\Repositories\Interfaces\GalleryRepositoryInterface;
use App\Repositories\Interfaces\RuleRepositoryInterface;
use App\Repositories\Interfaces\KategoriRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

use App\Repositories\SettingRepository;
use App\Repositories\AuthRepository;
use App\Repositories\AkomodasiRepository;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\BannerRepository;
use App\Repositories\ContactRepository;
use App\Repositories\FasilitasRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\RuleRepository;
use App\Repositories\KategoriRepository;
use App\Repositories\Interfaces\GaleriesRepositoryInterface;
use App\Repositories\GaleriesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        $this->app->bind(
            AkomodasiRepositoryInterface::class,
            AkomodasiRepository::class
        );

        $this->app->bind(
            KategoriRepositoryInterface::class,
            KategoriRepository::class
        );

        $this->app->bind(
            ArticleCategoryRepositoryInterface::class,
            ArticleCategoryRepository::class
        );

        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );

        $this->app->bind(
            BannerRepositoryInterface::class,
            BannerRepository::class
        );

        $this->app->bind(
            ContactRepositoryInterface::class,
            ContactRepository::class
        );

        $this->app->bind(
            FasilitasRepositoryInterface::class,
            FasilitasRepository::class
        );

        $this->app->bind(
            GalleryRepositoryInterface::class,
            GalleryRepository::class
        );

        $this->app->bind(
            RuleRepositoryInterface::class,
            RuleRepository::class
        );

        $this->app->bind(
        AuthRepositoryInterface::class,
        AuthRepository::class
        );

        $this->app->bind(
        GaleriesRepositoryInterface::class,
        GaleriesRepository::class);

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
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
