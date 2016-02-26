<?php

/**
 * Service provider for UserNamingService.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace AAres\UserNaming;

use Illuminate\Support\ServiceProvider;
use AAres\UserNaming\UserNamingService;

/**
 * Class UserNamingServiceProvider.
 *
 * @package Aares\UserNaming
 */
class UserNamingServiceProvider extends ServiceProvider {

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
        $this->app->singleton('usernaming', function () {
            return new UserNamingService;
        });
    }

}