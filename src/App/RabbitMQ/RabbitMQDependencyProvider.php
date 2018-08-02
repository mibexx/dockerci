<?php
declare(strict_types=1);

namespace App\RabbitMQ;


use Xervice\EventRabbitMq\Business\Listener\QueueListener;
use Xervice\EventRabbitMq\Business\Queue\EventExchange;
use Xervice\EventRabbitMq\Business\Queue\EventQueue;
use Xervice\LogRabbitMq\Business\Queue\LogExchange;
use Xervice\LogRabbitMq\Business\Queue\LogQueue;
use Xervice\RabbitMQ\RabbitMQDependencyProvider as XerviceRabbitMQDependencyProvider;

class RabbitMQDependencyProvider extends XerviceRabbitMQDependencyProvider
{
    /**
     * @return \Xervice\RabbitMQ\Queue\QueueInterface[]
     */
    protected function getQueues(): array
    {
        return [
            new EventQueue(),
            new LogQueue()
        ];
    }

    /**
     * @return \Xervice\RabbitMQ\Exchange\ExchangeInterface[]
     */
    protected function getExchanges(): array
    {
        return [
            new EventExchange(),
            new LogExchange()
        ];
    }

    /**
     * @return \Xervice\RabbitMQ\Worker\Listener\ListenerInterface[]
     */
    protected function getListener(): array
    {
        return [
            new QueueListener()
        ];
    }
}