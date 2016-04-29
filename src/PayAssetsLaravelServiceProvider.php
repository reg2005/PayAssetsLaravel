<?php

namespace reg2005\PayAssetsLaravel;

use Illuminate\Support\ServiceProvider;
//use reg2005\QiwiPayLaravel\Http\Middleware\OnlyCli;

class PayAssetsLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {

        $router->middleware('OnlyCli', 'reg2005\PayAssetsLaravel\Http\Middleware\OnlyCli');

        //require __DIR__ . '/Http/routes.php';
        $this->publishes([
            __DIR__.'/migrations/' => base_path('/database/migrations'),
        ], 'migrations');


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }
}