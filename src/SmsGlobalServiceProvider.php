<?php

namespace JoshuaChinemezu\SmsGlobal;

use Illuminate\Support\ServiceProvider;

class SmsGlobalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('smsglobal-laravel', function () {

            return new RestApi\RestApiClient;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__ . '/../config/smsglobal.php');

        $this->publishes([
            $config => config_path('smsglobal.php')
        ]);
    }
}
