<?php

/**
 * Token service provider.
 */

namespace App\Providers;

use App\Service\TokenService;
use Illuminate\Support\ServiceProvider;

/**
 * Class CacheServiceProvider.
 *
 * @package App\Providers
 */
class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('token', function () {
            return new TokenService();
        });
    }

    /**
     * Boot the service.
     * This method is called after all service providers have been registered.
     */
    public function boot()
    {

    }
}
