<?php

namespace Faheem00\LaravelGoogleAuthenticator\Providers;

use Illuminate\Support\ServiceProvider;
use Faheem00\LaravelGoogleAuthenticator\GoogleAuthenticator;

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
        $this->app->singleton(GoogleAuthenticator::class, function ($app) {
            return new GoogleAuthenticator();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [GoogleAuthenticator::class];
    }
}
