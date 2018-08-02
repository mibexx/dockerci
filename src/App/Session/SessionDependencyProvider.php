<?php
declare(strict_types=1);

namespace App\Session;


use Xervice\Redis\Session\RedisSessionHandler;
use Xervice\Session\SessionDependencyProvider as XerviceSessionDependencyProvider;

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
            $this->getLocator()->redis()->client()
        );
    }
}