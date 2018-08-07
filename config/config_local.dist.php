<?php

use Xervice\Database\DatabaseConfig;
use Xervice\GithubAuth\GithubAuthConfig;
use Xervice\RabbitMQ\RabbitMQConfig;
use Xervice\Redis\RedisConfig;

// RabbitMQ
$config[RabbitMQConfig::CONNECTION_PASSWORD] = 'guest';

// Redis
$config[RedisConfig::REDIS_PASSWORD] = '';

// Database
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = 'dockerci';

// Github
$config[GithubAuthConfig::CLIENT_ID] = '';
$config[GithubAuthConfig::CLIENT_SECRET] = '';
