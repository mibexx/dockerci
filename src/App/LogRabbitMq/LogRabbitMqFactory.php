<?php


namespace App\LogRabbitMq;


use App\LogRabbitMq\Business\FileLogger\LogToFileHandler;
use App\LogRabbitMq\Business\FileLogger\LogToFileHandlerInterface;
use Xervice\LogRabbitMq\LogRabbitMqFactory as XerviceLogRabbitMqFactory;

/**
 * @method \App\LogRabbitMq\LogRabbitMqConfig getConfig()
 */
class LogRabbitMqFactory extends XerviceLogRabbitMqFactory
{
    /**
     * @return \App\LogRabbitMq\Business\FileLogger\LogToFileHandlerInterface
     */
    public function createLogToFileHandler(): LogToFileHandlerInterface
    {
        return new LogToFileHandler(
            $this->getConfig()->getQueueName(),
            $this->getConfig()->getLogFilename()
        );
    }
}