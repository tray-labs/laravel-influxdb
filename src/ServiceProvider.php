<?php

namespace TrayLabs\InfluxDB\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use InfluxDB\Client as InfluxClient;

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
        $this->app->singleton('InfluxDB\Client::class', function($app) {
                $client = new InfluxClient(
                        config('influxdb.host'),
                        config('influxdb.port'),
                        config('influxdb.username'),
                        config('influxdb.password'),
                        config('influxdb.ssl'),
                        config('influxdb.verifySSL'),
                        config('influxdb.timeout'),
                );
            return $client->selectDB(config('influxdb.dbname'));
        });
    }
}
