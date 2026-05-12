<?php

namespace TrayLabs\InfluxDB\Tests;

use InfluxDB2\Client as InfluxDB2Client;
use Orchestra\Testbench\TestCase;
use TrayLabs\InfluxDB\Providers\ServiceProvider;

class UrlBuildingTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    private function makeClient(array $config): InfluxDB2Client
    {
        foreach ($config as $key => $value) {
            $this->app['config']->set("influxdb.{$key}", $value);
        }

        $this->app->forgetInstance(InfluxDB2Client::class);

        return $this->app->make(InfluxDB2Client::class);
    }

    public function test_http_url_when_ssl_is_false(): void
    {
        $client = $this->makeClient([
            'host' => 'myhost',
            'port' => 8086,
            'ssl'  => false,
            'token' => 'tok',
            'org' => 'org',
            'bucket' => 'bkt',
        ]);

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }

    public function test_https_url_when_ssl_is_true(): void
    {
        $client = $this->makeClient([
            'host' => 'myhost',
            'port' => 8086,
            'ssl'  => true,
            'token' => 'tok',
            'org' => 'org',
            'bucket' => 'bkt',
        ]);

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }

    public function test_custom_port_is_used(): void
    {
        $client = $this->makeClient([
            'host' => 'myhost',
            'port' => 9999,
            'ssl'  => false,
            'token' => 'tok',
            'org' => 'org',
            'bucket' => 'bkt',
        ]);

        $this->assertInstanceOf(InfluxDB2Client::class, $client);
    }
}
