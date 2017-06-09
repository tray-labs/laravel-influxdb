<?php

return [
    'host' => env('INFLUXDB_HOST', 'localhost'),
    'port' => env('INFLUXDB_PORT', '8086'),
    'username' => env('INFLUXDB_USER', ''),
    'password' => env('INFLUXDB_PASSWORD', ''),
    'ssl' => env('INFLUXDB_SLL', 'false'),
    'verifySSL' => env('INFLUXDB_VERIFYSSL', 'false'),
    'timeout' => env('INFLUXDB_TIMEOUT', '0'),
    'database' => env('INFLUXDB_DATABASE', ''),
];
