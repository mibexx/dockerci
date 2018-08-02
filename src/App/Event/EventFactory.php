<?php
declare(strict_types=1);

namespace App\Event;


use Xervice\Event\Business\Provider\EventProviderInterface;
use Xervice\Event\EventFactory as XerviceEventFactory;
use Xervice\EventRabbitMq\Business\EventProvider\RabbitMqEventProvider;

class EventFactory extends XerviceEventFactory
{
    /**
     * @return \Xervice\Event\Business\Provider\EventProviderInterface
     */
    public function createEventProvider(): EventProviderInterface
    {
        return new RabbitMqEventProvider();
    }
}