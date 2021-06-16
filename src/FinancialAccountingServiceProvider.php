<?php

namespace Rutatiina\FinancialAccounting;

use Illuminate\Support\ServiceProvider;

class FinancialAccountingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes/routes.php';
        include __DIR__.'/routes/api.php';

        //$this->loadViewsFrom(__DIR__.'/resources/views/lucid/h-menu', 'accounting');
        //$this->loadViewsFrom(__DIR__.'/resources/views/azia', 'accounting');
        $this->loadViewsFrom(__DIR__.'/resources/views/limitless', 'financial-accounting');
        $this->loadViewsFrom(__DIR__.'/resources/views/limitless-bs4', 'limitless-bs4');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Rutatiina\FinancialAccounting\Http\Controllers\FinancialAccountingController');
    }
}
