<?php

namespace App\Providers;

use App\Services\ErrorInfoService;
use Illuminate\Support\ServiceProvider;

class ErrorInfoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('error.info', function () {
            return new ErrorInfoService();
        });

        $this->app->bind('App\Contracts\ErrorInfoContract', function () {
           return new ErrorInfoService();
        });
    }
}
