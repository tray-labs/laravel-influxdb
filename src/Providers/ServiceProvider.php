<?php

namespace TrayLabs\InfluxDB\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use InfluxDB\Client as InfluxClient;
use InfluxDB\Database as InfluxDB;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '../config/InfluxDB.php' => config_path('influxdb.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(InfluxDB::class, function($app) {
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            InfluxDB::class,
        ];
    }
}
