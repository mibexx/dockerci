<?php


namespace App\LogRabbitMq;


use Xervice\Config\XerviceConfig;

class LogRabbitMqConfig extends \Xervice\LogRabbitMq\LogRabbitMqConfig
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