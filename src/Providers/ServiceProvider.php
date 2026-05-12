<?php

namespace TrayLabs\InfluxDB\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use InfluxDB2\Client as InfluxDB2Client;

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/InfluxDB.php' => config_path('influxdb.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton(InfluxDB2Client::class, function ($app) {
            $scheme = config('influxdb.ssl') ? 'https' : 'http';
            return new InfluxDB2Client([
                'url'       => "{$scheme}://" . config('influxdb.host') . ':' . config('influxdb.port'),
                'token'     => config('influxdb.token'),
                'bucket'    => config('influxdb.bucket'),
                'org'       => config('influxdb.org'),
                'timeout'   => config('influxdb.timeout', 0),
                'verifySSL' => config('influxdb.verifySSL', false),
            ]);
        });
        $this->app->alias(InfluxDB2Client::class, 'influxdb');
    }

    public function provides()
    {
        return [
            InfluxDB2Client::class,
            'influxdb',
        ];
    }
}
