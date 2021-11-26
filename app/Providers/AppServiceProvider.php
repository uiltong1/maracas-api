<?php

namespace App\Providers;

use App\Http\Interfaces\MediaInterface;
use App\Http\Interfaces\TaleInterface;
use App\Services\MediaService;
use App\Services\TaleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TaleInterface::class,
            TaleService::class
        );

        $this->app->bind(
            MediaInterface::class,
            MediaService::class
        );
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
