<?php

use Xervice\Database\DatabaseConfig;
use Xervice\RabbitMQ\RabbitMQConfig;
use Xervice\Redis\RedisConfig;

// RabbitMQ
$config[RabbitMQConfig::CONNECTION_PASSWORD] = 'guest';

// Redis
$config[RedisConfig::REDIS_PASSWORD] = '';

// Database
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = 'dockerci';