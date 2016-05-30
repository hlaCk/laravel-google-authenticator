<?php

namespace Faheem00\LaravelGoogleAuthenticator\Providers;

use PHPGangsta_GoogleAuthenticator;
use Illuminate\Support\ServiceProvider;

class GoogleAuthenticatorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $app['googleauthenticator'] = $this->app->singleton(PHPGangsta_GoogleAuthenticator::class, function ($app) {
            return new PHPGangsta_GoogleAuthenticator();
        });
        $app->alias('googleauthenticator',PHPGangsta_GoogleAuthenticator::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PHPGangsta_GoogleAuthenticator::class];
    }
}
