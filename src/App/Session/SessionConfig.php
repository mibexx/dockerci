<?php


namespace App\Session;



use Xervice\Core\Business\Model\Config\AbstractConfig;

class SessionConfig extends AbstractConfig
{
    public const SESSION_TTL = 'session.ttl';

    public const SESSION_PREFIX = 'session.prefix';

    /**
     * @return int
     */
    public function getSessionTtl(): int
    {
        return $this->get(self::SESSION_TTL, 3600);
    }

    /**
     * @return string
     */
    public function getSessionPrefix(): string
    {
        return $this->get(self::SESSION_PREFIX, 'session:xervice.');
    }
}