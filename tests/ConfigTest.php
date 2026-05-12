<?php

namespace TrayLabs\InfluxDB\Tests;

use Orchestra\Testbench\TestCase;
use TrayLabs\InfluxDB\Providers\ServiceProvider;

class ConfigTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    public function test_config_defaults_are_correct(): void
    {
        $config = require __DIR__ . '/../config/InfluxDB.php';

        $this->assertSame('localhost', $config['host']);
        $this->assertSame(8086, $config['port']);
        $this->assertSame(false, $config['ssl']);
        $this->assertSame(false, $config['verifySSL']);
        $this->assertSame(0, $config['timeout']);
        $this->assertSame('', $config['token']);
        $this->assertSame('', $config['org']);
        $this->assertSame('', $config['bucket']);
    }

    public function test_config_does_not_contain_removed_v1_keys(): void
    {
        $config = require __DIR__ . '/../config/InfluxDB.php';

        $this->assertArrayNotHasKey('username', $config);
        $this->assertArrayNotHasKey('password', $config);
        $this->assertArrayNotHasKey('dbname', $config);
        $this->assertArrayNotHasKey('udp', $config);
    }

    public function test_config_contains_required_v2_keys(): void
    {
        $config = require __DIR__ . '/../config/InfluxDB.php';

        $this->assertArrayHasKey('token', $config);
        $this->assertArrayHasKey('org', $config);
        $this->assertArrayHasKey('bucket', $config);
    }
}
