<?php

namespace App\Providers;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\RateRepository;
use App\Repositories\RateRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repository service provider services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
