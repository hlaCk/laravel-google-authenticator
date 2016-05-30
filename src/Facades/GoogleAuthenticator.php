<?php

namespace Faheem00\LaravelGoogleAuthenticator\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleAuthenticator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \PHPGangsta_GoogleAuthenticator::class;
    }
}
