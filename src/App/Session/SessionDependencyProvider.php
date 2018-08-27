<?php
declare(strict_types=1);

namespace App\Session;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Redis\Communication\Plugin\RedisSessionHandler;
use Xervice\Session\SessionDependencyProvider as XerviceSessionDependencyProvider;

/**
 * @method \App\Session\SessionConfig getConfig()
 */
class SessionDependencyProvider extends XerviceSessionDependencyProvider
{
    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \SessionHandlerInterface
     */
    protected function getSessionHandler(DependencyContainerInterface $container): \SessionHandlerInterface
    {
        return new RedisSessionHandler(
            [
                'prefix' => $this->getConfig()->getSessionPrefix(),
                'ttl'    => $this->getConfig()->getSessionTtl()
            ]
        );
    }
}