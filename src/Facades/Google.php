<?php

namespace PmMotors\Google\Facades;

use Illuminate\Support\Facades\Facade;
use PmMotors\Google\Client;

class Google extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'google.api.client';
    }
}
