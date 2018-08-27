<?php
declare(strict_types=1);

namespace App\RabbitMQ;


use App\LogRabbitMq\Business\Model\Listener\LogToFileListener;
use Xervice\EventRabbitMq\Business\Plugin\Listener\QueueListener;
use Xervice\EventRabbitMq\Business\Plugin\Queue\EventExchange;
use Xervice\EventRabbitMq\Business\Plugin\Queue\EventQueue;
use Xervice\LogRabbitMq\Business\Plugin\Queue\LogExchange;
use Xervice\LogRabbitMq\Business\Plugin\Queue\LogQueue;
use Xervice\RabbitMQ\RabbitMQDependencyProvider as XerviceRabbitMQDependencyProvider;

class RabbitMQDependencyProvider extends XerviceRabbitMQDependencyProvider
{
    /**
     * @return \Xervice\RabbitMQ\Business\Dependency\Worker\Listener\ListenerInterface[]
     */
    protected function getListener(): array
    {
        return [
            new QueueListener(),
            new LogToFileListener()
        ];
    }

    /**
     * @return \Xervice\RabbitMQ\Business\Dependency\Queue\QueueInterface[]
     */
    protected function getQueues(): array
    {
        return [
            new EventQueue(),
            new LogQueue()
        ];
    }

    /**
     * @return \Xervice\RabbitMQ\Business\Dependency\Exchange\ExchangeInterface[]
     */
    protected function getExchanges(): array
    {
        return [
            new EventExchange(),
            new LogExchange()
        ];
    }
}