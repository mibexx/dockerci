<?php

namespace App\LogRabbitMq\Business\Model\FileLogger;

use DataProvider\LogMessageDataProvider;

interface LogToFileHandlerInterface
{
    /**
     * @return string
     */
    public function getQueueName(): string;

    /**
     * @param \DataProvider\LogMessageDataProvider $messageDataProvider
     */
    public function handleLog(LogMessageDataProvider $messageDataProvider): void;
}