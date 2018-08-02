<?php

use Xervice\Database\DatabaseConfig;

$dsn = sprintf(
    '%s:host=%s;port=%d;dbname=%s;user=%s;password=%s',
    $config[DatabaseConfig::PROPEL_CONF_ADAPTER],
    $config[DatabaseConfig::PROPEL_CONF_HOST],
    $config[DatabaseConfig::PROPEL_CONF_PORT],
    $config[DatabaseConfig::PROPEL_CONF_DBNAME],
    $config[DatabaseConfig::PROPEL_CONF_USER],
    $config[DatabaseConfig::PROPEL_CONF_PASSWORD]
);

$config[DatabaseConfig::PROPEL] = [
    'propel' => [
        'database'  => [
            'connections' => [
                'default' => [
                    'adapter'    => $config[DatabaseConfig::PROPEL_CONF_ADAPTER],
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => $dsn,
                    'user'       => $config[DatabaseConfig::PROPEL_CONF_USER],
                    'password'   => $config[DatabaseConfig::PROPEL_CONF_PASSWORD],
                    'attributes' => [
                        'ATTR_EMULATE_PREPARES' => false,
                        'ATTR_TIMEOUT'          => 30
                    ]
                ]
            ],
        ],
        'runtime'   => [
            'defaultConnection' => 'default',
            'connections'       => ['default']
        ],
        'generator' => [
            'defaultConnection' => 'default',
            'connections'       => ['default'],
            'recursive'         => true,
            'tablePrefix'       => 'app_'
        ],
        'paths'     => [
            'projectDir'   => dirname(dirname(__DIR__)),
            'schemaDir'    => dirname(dirname(__DIR__)) . '/src',
            'outputDir'    => dirname(dirname(__DIR__)) . '/src/Orm/Output',
            'phpDir'       => dirname(dirname(__DIR__)) . '/src/',
            'migrationDir' => dirname(dirname(__DIR__)) . '/src/Orm/Migrations',
            'phpConfDir'   => dirname(dirname(__DIR__)) . '/src/Orm/Config',
            'sqlDir'       => dirname(dirname(__DIR__)) . '/src/Orm/Sql'
        ],
    ]
];