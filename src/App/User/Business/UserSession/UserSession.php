<?php


namespace App\User\Business\UserSession;


use DataProvider\UserDataProvider;
use Xervice\Session\SessionClient;

class UserSession implements UserSessionInterface
{
    private const LOGIN_SESSION_KEY = 'dockerci:user:data';

    /**
     * @var \Xervice\Session\SessionClient
     */
    private $sessionClient;

    /**
     * UserSession constructor.
     *
     * @param \Xervice\Session\SessionClient $sessionClient
     */
    public function __construct(SessionClient $sessionClient)
    {
        $this->sessionClient = $sessionClient;
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     */
    public function loginUser(UserDataProvider $userDataProvider): void
    {
        if ($userDataProvider->hasUserId() && $userDataProvider->hasEmail()) {
            $this->sessionClient->set(self::LOGIN_SESSION_KEY, json_encode($userDataProvider->toArray()));
        }
    }

    public function logoutUser(): void
    {
        $this->sessionClient->remove(self::LOGIN_SESSION_KEY);
    }

    /**
     * @return \DataProvider\UserDataProvider|null
     */
    public function getLoggedUser(): ?UserDataProvider
    {
        $userDataProvider = null;

        if ($this->sessionClient->has(self::LOGIN_SESSION_KEY)) {
            $userDataProvider = new UserDataProvider();
            $userDataProvider->fromArray(
                json_decode(
                    $this->sessionClient->get(self::LOGIN_SESSION_KEY),
                    true
                )
            );
        }

        return $userDataProvider;
    }
}