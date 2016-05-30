<?php

namespace Faheem00\LaravelGoogleAuthenticator\Facades;

use Faheem00\LaravelGoogleAuthenticator\GoogleAuthenticator;
use Illuminate\Support\Facades\Facade;

class GoogleAuthenticatorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GoogleAuthenticator::class;
    }
}
