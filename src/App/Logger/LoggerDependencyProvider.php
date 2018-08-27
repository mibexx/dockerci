<?php
declare(strict_types=1);

namespace App\Logger;


use Xervice\Logger\LoggerDependencyProvider as XerviceLoggerDependencyProvider;
use Xervice\LogRabbitMq\Business\Plugin\Log\QueueLogHandler;

class LoggerDependencyProvider extends XerviceLoggerDependencyProvider
{
    /**
     * @return \Xervice\Logger\Business\Dependency\Handler\LogHandlerInterface[]
     */
    protected function getLogHandler(): array
    {
        return [
            new QueueLogHandler()
        ];
    }
}