# Laravel Influxdb

A service made to provide, set up and use [influxdb-client-php](https://github.com/influxdata/influxdb-client-php) (InfluxDB 2.x) in Laravel.

## Installing

```sh
composer require tray-labs/laravel-influxdb
```

## Register service provider (pick one of two).

- `Laravel`: in `config/app.php` file. `Laravel 5.5+ supports package discovery automatically, you should skip this step`
    ```php
    'providers' => [
        TrayLabs\InfluxDB\Providers\ServiceProvider::class,
    ]
    ```
    ```php
    'aliases' => [
        'InfluxDB' => TrayLabs\InfluxDB\Facades\InfluxDB::class,
    ]
    ```
- `Lumen`: in `bootstrap/app.php` file
    ```php
    $app->configure('InfluxDB');
    $app->register(TrayLabs\InfluxDB\Providers\LumenServiceProvider::class);
    $app->alias('InfluxDB', TrayLabs\InfluxDB\Facades\InfluxDB::class);
    ```

## Configuration

Define the env variables to connect to InfluxDB:

```ini
INFLUXDB_HOST=localhost
INFLUXDB_PORT=8086
INFLUXDB_TOKEN=my-token
INFLUXDB_ORG=my-org
INFLUXDB_BUCKET=my-bucket
INFLUXDB_SSL=false
INFLUXDB_VERIFYSSL=false
INFLUXDB_TIMEOUT=0
```

Publish the config file:

```sh
php artisan vendor:publish
```

## Writing Data

```php
use InfluxDB2\Point;

$writeApi = InfluxDB::createWriteApi();

$point = Point::measurement('test_metric')
    ->addTag('host', 'server01')
    ->addTag('region', 'us-west')
    ->addField('cpucount', 10)
    ->time(microtime(true));

$writeApi->write($point);
$writeApi->close();
```

## Reading Data

```php
$queryApi = InfluxDB::createQueryApi();

$result = $queryApi->query(
    'from(bucket:"my-bucket") |> range(start: -1h) |> filter(fn: (r) => r._measurement == "test_metric")'
);

foreach ($result as $table) {
    foreach ($table->records as $record) {
        echo $record->getField() . ': ' . $record->getValue() . PHP_EOL;
    }
}
```

## License

This project is licensed under the MIT License
