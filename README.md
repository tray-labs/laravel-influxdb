# Laravel Influxdb

A service made to provide, set up and use the library from influxdata [influxdb-php](https://github.com/influxdata/influxdb-php/) in Laravel.

## Installing

* Add this line to require section of ```composer.json``` and execute on your terminal ```$ composer install```

```
"require": {
    "tray-labs/laravel-influxdb": "*"
}
```


## This package use auto-discover, if using less than version laravel 5.5 you must use below settings

* Add this lines to yours config/app.php (Use only with Laravel version less than 5.5 )

```
'providers' => [
//  ...
    TrayLabs\InfluxDB\Providers\ServiceProvider::class,
]
```

```
'aliases' => [
//  ...
    'InfluxDB' => TrayLabs\InfluxDB\Facades\InfluxDB::class,
]
```

* Define env variables to connect to InfluxDB

```ini
INFLUXDB_HOST=localhost
INFLUXDB_PORT=8086
INFLUXDB_USER=some_user
INFLUXDB_PASSWORD=some_password
INFLUXDB_SSL=false
INFLUXDB_VERIFYSSL=false
INFLUXDB_TIMEOUT=0
INFLUXDB_DBNAME=some_database
```

* Write this into your terminal inside your project

```ini
php artisan vendor:publish
```

## Reading Data

```php
<?php

// executing a query will yield a resultset object
$result = InfluxDB::query('select * from test_metric LIMIT 5');

// get the points from the resultset yields an array
$points = $result->getPoints();
```

## Writing Data

```php
<?php

// create an array of points
$points = array(
    new InfluxDB\Point(
        'test_metric', // name of the measurement
        null, // the measurement value
        ['host' => 'server01', 'region' => 'us-west'], // optional tags
        ['cpucount' => 10], // optional additional fields
        time() // Time precision has to be set to seconds!
    ),
    new InfluxDB\Point(
        'test_metric', // name of the measurement
        null, // the measurement value
        ['host' => 'server01', 'region' => 'us-west'], // optional tags
        ['cpucount' => 10], // optional additional fields
        time() // Time precision has to be set to seconds!
    )
);

$result = InfluxDB::writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
```

License
----

This project is licensed under the MIT License
