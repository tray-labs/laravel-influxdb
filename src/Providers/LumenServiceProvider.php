<?php
/**
 * @author ChenDasheng
 * @created 2022/2/10 22:27
 */

namespace TrayLabs\InfluxDB\Providers;

use Illuminate\Support\ServiceProvider;
use InfluxDB\Client as InfluxClient;
use InfluxDB\Database as InfluxDB;
use InfluxDB\Driver\UDP;

class LumenServiceProvider extends ServiceProvider
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
        $path = realpath(__DIR__ . '/../../config/InfluxDB.php');
        $this->mergeConfigFrom($path, 'influxdb');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(InfluxDB::class, function ($app) {
            $client = new InfluxClient(
                config('influxdb.host'),
                config('influxdb.port'),
                config('influxdb.username'),
                config('influxdb.password'),
                config('influxdb.ssl'),
                config('influxdb.verifySSL'),
                config('influxdb.timeout')
            );
            if (config('influxdb.udp.enabled') === true) {
                $client->setDriver(new UDP(
                    $client->getHost(),
                    config('influxdb.udp.port')
                ));
            }
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