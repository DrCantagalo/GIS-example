<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        // Isso diz ao Passport: "Quando alguém pedir autorização, mostre esta view"
        Passport::authorizesRequestsVia(function () {
            return view('vendor.passport.authorize');
        });
    }
}
