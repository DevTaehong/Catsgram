<?php

namespace App\Providers;

use App\Theme;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //source: https://just1and0.medium.com/how-to-setup-database-on-heroku-for-your-laravel-application-6a903c2c75c7
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(App::environment('production')) {
            URL::forceScheme('https');
        }
    }
}
