<?php

namespace TrayLabs\InfluxDB\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use InfluxDB\Client as InfluxClient;
use InfluxDB\Client\Exception as ClientException;

class InfluxDBServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '../config/InfluxDB.php' => config_path('influxdb.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton('InfluxDB\Client', function($app) {
            try {
                return InfluxClient::fromDSN(
                    sprintf('%s://%s:%s@%s:%s/%s',
                        config('influxdb.user'),
                        config('influxdb.password'),
                        config('influxdb.host'),
                        config('influxdb.port'),
                        config('influxdb.database')
                    )
                );
            } catch (ClientException $e) {
                return null;
            }
        });
    }
}
