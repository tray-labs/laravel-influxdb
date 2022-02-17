<?php

namespace TrayLabs\InfluxDB\Providers;

class LumenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__ . '/../../config/InfluxDB.php');
        $this->mergeConfigFrom($path, 'influxdb');
    }
}
