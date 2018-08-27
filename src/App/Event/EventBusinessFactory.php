<?php
declare(strict_types=1);

namespace App\Event;


use Xervice\Event\Business\EventBusinessFactory as XerviceEventBusinessFactory;
use Xervice\Event\Business\Model\Provider\EventProviderInterface;
use Xervice\EventRabbitMq\Business\Plugin\EventProvider\RabbitMqEventProvider;

class EventBusinessFactory extends XerviceEventBusinessFactory
{
    /**
     * @return \Xervice\Event\Business\Model\Provider\EventProviderInterface
     */
    public function createEventProvider(): EventProviderInterface
    {
        return new RabbitMqEventProvider();
    }
}