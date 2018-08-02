<?php


use Xervice\Database\DatabaseConfig;
use Xervice\RabbitMQ\RabbitMQConfig;
use Xervice\Redis\RedisConfig;

// RabbitMQ
$config[RabbitMQConfig::CONNECTION_HOST] = '127.0.0.1';
$config[RabbitMQConfig::CONNECTION_PORT] = 5672;
$config[RabbitMQConfig::CONNECTION_USERNAME] = 'guest';
$config[RabbitMQConfig::CONNECTION_PASSWORD] = 'guest';
$config[RabbitMQConfig::CONNECTION_VIRTUALHOST] = '/';

// Redis
$config[RedisConfig::REDIS_HOST] = '127.0.0.1';
$config[RedisConfig::REDIS_PORT] = 6379;


// Database
$config[DatabaseConfig::PROPEL_CONF_HOST] = '127.0.0.1';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '5432';
$config[DatabaseConfig::PROPEL_CONF_DBNAME] = 'travis_ci_test';
$config[DatabaseConfig::PROPEL_CONF_USER] = 'postgres';
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = '';