<?php
declare(strict_types=1);

namespace App\Kernel;


use Xervice\Api\Business\Plugin\ApiAuthService;
use Xervice\Database\Communication\Plugin\DatabaseService;
use Xervice\ExceptionHandler\Communication\Plugin\ExceptionService;
use Xervice\Kernel\KernelDependencyProvider as XerviceKernelDependencyProvider;
use Xervice\RabbitMQ\Communication\Plugin\RabbitMqService;
use Xervice\Redis\Communication\Plugin\RedisService;
use Xervice\Session\Communication\Plugin\SessionService;
use Xervice\Twig\Communication\Plugin\TwigService;
use Xervice\Web\Communication\Plugin\WebService;

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