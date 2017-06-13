<?php

namespace TrayLabs\InfluxDB\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use InfluxDB\Client as InfluxClient;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return InfluxClient::class;
    }
}