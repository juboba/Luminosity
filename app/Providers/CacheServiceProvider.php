<?php

namespace App\Providers;

use App\Service\TokenService;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    //protected $defer = true;
    /**
     * Register any application services.
     */
    public function register()
    {

        $this->app->singleton('App\Service\TokenService', function() {
            return new TokenService();
        });

    }


    public function boot()
    {

    }
}
