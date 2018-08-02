<?php
declare(strict_types=1);

namespace App\Kernel;


use Xervice\Api\Business\Kernel\ApiAuthService;
use Xervice\Database\Kernel\DatabaseService;
use Xervice\ExceptionHandler\Business\Kernel\ExceptionService;
use Xervice\Kernel\KernelDependencyProvider as XerviceKernelDependencyProvider;
use Xervice\RabbitMQ\Kernel\RabbitMqService;
use Xervice\Redis\Kernel\RedisService;
use Xervice\Session\Business\Kernel\SessionService;
use Xervice\Twig\Business\Kernel\TwigService;
use Xervice\Web\Business\Kernel\WebService;

class KernelDependencyProvider extends XerviceKernelDependencyProvider
{
    /**
     * Service classes with key as service name
     * e.g.
     * myService => myservice::class
     *
     * @return array
     */
    protected function getServiceList(): array
    {
        return [
            'redis' => RedisService::class,
            'rabbitmq' => RabbitMqService::class,
            'session' => SessionService::class,
            'database' => DatabaseService::class,
            'api' => ApiAuthService::class,
            'twig' => TwigService::class,
            'exception' => ExceptionService::class,
            'web' => WebService::class
        ];
    }
}