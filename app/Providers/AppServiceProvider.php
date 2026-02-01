<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::routes();

        // Isso diz ao Passport: "Quando alguém pedir autorização, mostre esta view"
        Passport::authorizesRequestsVia(function () {
            return view('vendor.passport.authorize');
        });
    }
}
