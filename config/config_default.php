<?php

use Xervice\Config\XerviceConfig;
use Xervice\Core\CoreConfig;
use Xervice\Database\DatabaseConfig;
use Xervice\DataProvider\DataProviderConfig;
use Xervice\ExceptionHandler\ExceptionHandlerConfig;
use Xervice\RabbitMQ\RabbitMQConfig;
use Xervice\Redis\RedisConfig;

// Core
$config[CoreConfig::PROJECT_LAYER_NAMESPACE] = 'App';

// Debug
$config[ExceptionHandlerConfig::IS_DEBUG] = true;

// Data-Provider
$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = dirname(__DIR__) . '/src/Generated';
$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    dirname(__DIR__) . '/src/',
    dirname(__DIR__) . '/vendor/'
];

// RabbitMQ
$config[RabbitMQConfig::CONNECTION_HOST] = '127.0.0.1';
$config[RabbitMQConfig::CONNECTION_PORT] = 5672;
$config[RabbitMQConfig::CONNECTION_INSIST] = false;
$config[RabbitMQConfig::CONNECTION_LOGIN_METHOD] = 'AMQPLAIN';
$config[RabbitMQConfig::CONNECTION_LOCALE] = 'de_DE';
$config[RabbitMQConfig::CONNECTION_CONNECTION_TIMEOUT] = 3.0;
$config[RabbitMQConfig::CONNECTION_READWRITE_TIMEOUT] = 3.0;
$config[RabbitMQConfig::CONNECTION_CONTEXT] = null;
$config[RabbitMQConfig::CONNECTION_KEEPALIVE] = false;
$config[RabbitMQConfig::CONNECTION_HEARTBEAT] = 0;

$config[RabbitMQConfig::CONSUMER_TAG] = '';
$config[RabbitMQConfig::CONSUMER_NOLOCAL] = false;
$config[RabbitMQConfig::CONSUMER_NOACK] = false;
$config[RabbitMQConfig::CONSUMER_EXCLUSIVE] = false;
$config[RabbitMQConfig::CONSUMER_NOWAIT] = false;
$config[RabbitMQConfig::CONSUMER_TICKET] = null;
$config[RabbitMQConfig::CONSUMER_ARGUMENTS] = [];

// Redis
$config[RedisConfig::REDIS_HOST] = '127.0.0.1';
$config[RedisConfig::REDIS_PORT] = 6379;
$config[RedisConfig::REDIS_PASSWORD] = '';
$config[RedisConfig::REDIS_DATABASE] = 0;


// Database
$config[DatabaseConfig::PROPEL_CONF_DIR] = __DIR__ . '/propel';
$config[DatabaseConfig::PROPEL_CONF_ADAPTER] = 'pgsql';
$config[DatabaseConfig::PROPEL_CONF_HOST] = '127.0.0.1';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '5432';

// Define static configs
$config[XerviceConfig::ADDITIONAL_CONFIG_FILES] = [
    __DIR__ . '/static/config_propel.php',
    __DIR__ . '/static/config_redis.php'
];