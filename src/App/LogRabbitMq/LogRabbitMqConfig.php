<?php


namespace App\LogRabbitMq;


use Xervice\Config\Business\XerviceConfig;
use Xervice\LogRabbitMq\LogRabbitMqConfig as XerviceLogRabbitMqConfig;

class LogRabbitMqConfig extends XerviceLogRabbitMqConfig
{
    public const LOG_FILENAME = 'lograbbitmq.log.filename';

    /**
     * @return string
     */
    public function getLogFilename(): string
    {
        return $this->get(
            self::LOG_FILENAME,
            $this->get(
                XerviceConfig::APPLICATION_PATH
            ) . '/logs/dockerci.log'
        );
    }
}