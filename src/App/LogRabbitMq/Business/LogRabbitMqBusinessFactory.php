<?php


namespace App\LogRabbitMq;


use App\LogRabbitMq\Business\Model\FileLogger\LogToFileHandler;
use App\LogRabbitMq\Business\Model\FileLogger\LogToFileHandlerInterface;
use Xervice\LogRabbitMq\Business\LogRabbitMqBusinessFactory as XerviceLogRabbitMqBusinessFactory;

/**
 * @method \App\LogRabbitMq\LogRabbitMqConfig getConfig()
 */
class LogRabbitMqBusinessFactory extends XerviceLogRabbitMqBusinessFactory
{
    /**
     * @return \App\LogRabbitMq\Business\Model\FileLogger\LogToFileHandlerInterface
     */
    public function createLogToFileHandler(): LogToFileHandlerInterface
    {
        return new LogToFileHandler(
            $this->getConfig()->getQueueName(),
            $this->getConfig()->getLogFilename()
        );
    }
}