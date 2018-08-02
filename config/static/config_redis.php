<?php

use Xervice\Redis\RedisConfig;

$config[RedisConfig::REDIS_OPTIONS] = [
    'service'    => 'master',
    'parameters' => [
        'database' => $config[RedisConfig::REDIS_DATABASE]
    ]
];

if ($config[RedisConfig::REDIS_PASSWORD]) {
    $config[RedisConfig::REDIS_OPTIONS]['parameters']['password'] = $config[RedisConfig::REDIS_PASSWORD];
}

$config[RedisConfig::REDIS] = [
    'schema' => 'tcp',
    'host'   => $config[RedisConfig::REDIS_HOST],
    'port'   => $config[RedisConfig::REDIS_PORT]
];