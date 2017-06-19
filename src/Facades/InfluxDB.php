<?php

namespace TrayLabs\InfluxDB\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use InfluxDB\Database;

class InfluxDB extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Database::class;
    }
}