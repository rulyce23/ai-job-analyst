<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ServeCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend('command.serve', function () {
            return new ServeCommand();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
