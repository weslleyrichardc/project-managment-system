<?php

namespace App\Providers;

use App\Models\Address;
use App\Observers\AddressZipCodeObserver;
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
        Address::observe(AddressZipCodeObserver::class);
    }
}
