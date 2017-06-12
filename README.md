# Laravel Influxdb

A service made to provide, set up and use the library from influxdata [influxdb-php](https://github.com/influxdata/influxdb-php/) in Laravel.

## Installing

* Add this line to require section of ```composer.json``` and execute on your terminal ```$ composer install```

```
"require": {
    "tray-labs/laravel-influxdb": "*"
}
```

* Add this line to yours config/app.php

```
'providers' => [
//  ...
    TrayLabs\InfluxDB\Providers\InfluxDBServiceProvider::class,
]
```

'aliases' => [
//  ...
    'InfluxDB' => TrayLabs\InfluxDB\Facades\InfluxDB::class,
]
```

* Define env variables to connect to InfluxDB

```
    INFLUXDB_HOST=localhost
    INFLUXDB_PORT=8086
    INFLUXDB_USER=some_user
    INFLUXDB_PASSWORD=some_password
    INFLUXDB_SSL=false
    INFLUXDB_VERIFYSSL=false
    INFLUXDB_TIMEOUT=0
    INFLUXDB_DBNAME=some_database
```

## How to use

The usage is the same from [influxdb-php](https://github.com/influxdata/influxdb-php/) project.

License
----

This project is licensed under the MIT License
