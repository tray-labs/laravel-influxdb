<?php

namespace TrayLabs\InfluxDB\Tests;

use InfluxDB2\Client as InfluxDB2Client;
use Orchestra\Testbench\TestCase;
use TrayLabs\InfluxDB\Facades\InfluxDB;
use TrayLabs\InfluxDB\Providers\ServiceProvider;

class ServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'InfluxDB' => InfluxDB::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('influxdb.host', 'influxdb');
        $app['config']->set('influxdb.port', 8086);
        $app['config']->set('influxdb.token', 'test-token');
        $app['config']->set('influxdb.org', 'test-org');
        $app['config']->set('influxdb.bucket', 'test-bucket');
        $app['config']->set('influxdb.ssl', false);
        $app['config']->set('influxdb.verifySSL', false);
        $app['config']->set('influxdb.timeout', 30);
    }

    public function test_service_provider_registers_influxdb2_client(): void
    {
        $client = $this->app->make(InfluxDB2Client::class);

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }

    public function test_alias_resolves_to_influxdb2_client(): void
    {
        $client = $this->app->make('influxdb');

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }

    public function test_singleton_returns_same_instance(): void
    {
        $a = $this->app->make(InfluxDB2Client::class);
        $b = $this->app->make(InfluxDB2Client::class);

        $this->assertSame($a, $b);
    }

    public function test_facade_resolves_to_influxdb2_client(): void
    {
        $client = InfluxDB::getFacadeRoot();

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }

    public function test_provides_returns_expected_bindings(): void
    {
        $provider = new ServiceProvider($this->app);

        $this->assertEqualsCanonicalizing(
            [InfluxDB2Client::class, 'influxdb'],
            $provider->provides()
        );
    }

    public function test_client_can_create_write_api(): void
    {
        $client = $this->app->make(InfluxDB2Client::class);

        $writeApi = $client->createWriteApi();

        $this->assertNotNull($writeApi);
    }

    public function test_client_can_create_query_api(): void
    {
        $client = $this->app->make(InfluxDB2Client::class);

        $queryApi = $client->createQueryApi();

        $this->assertNotNull($queryApi);
    }
}
