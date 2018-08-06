<?php
declare(strict_types=1);

namespace App\Session;


use Xervice\Redis\Session\RedisSessionHandler;
use Xervice\Session\SessionDependencyProvider as XerviceSessionDependencyProvider;

/**
 * @method \App\Session\SessionConfig getConfig()
 */
class SessionDependencyProvider extends XerviceSessionDependencyProvider
{
    /**
     * @return \SessionHandlerInterface
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    protected function getSessionHandler(): \SessionHandlerInterface
    {
        return new RedisSessionHandler(
            $this->getLocator()->redis()->client(),
            [
                'prefix' => $this->getConfig()->getSessionPrefix(),
                'ttl'    => $this->getConfig()->getSessionTtl()
            ]
        );
    }


}