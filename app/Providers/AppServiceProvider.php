<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RuleRepository;
use App\Repositories\AccommodationCategoryRepository;
use App\Repositories\AccommodationRepository;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RuleRepository::class,
            RuleRepository::class
        );

        $this->app->bind(
            AccommodationCategoryRepository::class,
            AccommodationCategoryRepository::class
        );

        $this->app->bind(
            AccommodationRepository::class,
            AccommodationRepository::class
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
