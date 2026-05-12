<?php

return [
    'host'      => env('INFLUXDB_HOST', 'localhost'),
    'port'      => env('INFLUXDB_PORT', 8086),
    'ssl'       => env('INFLUXDB_SSL', false),
    'verifySSL' => env('INFLUXDB_VERIFYSSL', false),
    'timeout'   => env('INFLUXDB_TIMEOUT', 0),
    'token'     => env('INFLUXDB_TOKEN', ''),
    'org'       => env('INFLUXDB_ORG', ''),
    'bucket'    => env('INFLUXDB_BUCKET', ''),
];
