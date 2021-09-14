<?php

namespace App\Providers;

use App\Repository\DeveloperRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DeveloperRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     'App\Repositories\DeveloperRepositoryInterface',
        //     'App\Repositories\DeveloperRepository'
        // );

        $this->app->bind(DeveloperRepositoryInterface::class, DeveloperRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
