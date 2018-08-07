<?php


namespace App\User\Business\Authenticator;


use App\User\Business\Exception\AuthentificationException;
use App\User\Business\Password\PasswordHandlerInterface;
use App\User\Business\Reader\UserReader;
use App\User\Business\UserSession\UserSessionInterface;
use DataProvider\UserDataProvider;
use Xervice\Session\SessionClient;

class UserAuthenticator implements UserAuthenticatorInterface
{
    /**
     * @var \App\User\Business\UserSession\UserSessionInterface
     */
    private $userSession;

    /**
     * @var \App\User\Business\Reader\UserReader
     */
    private $userReader;

    /**
     * @var \App\User\Business\Password\PasswordHandlerInterface
     */
    private $passwordHandler;

    /**
     * UserAuthenticator constructor.
     *
     * @param \App\User\Business\UserSession\UserSessionInterface $userSession
     * @param \App\User\Business\Reader\UserReader $userReader
     * @param \App\User\Business\Password\PasswordHandlerInterface $passwordHandler
     */
    public function __construct(
        UserSessionInterface $userSession,
        UserReader $userReader,
        PasswordHandlerInterface $passwordHandler
    ) {
        $this->userSession = $userSession;
        $this->userReader = $userReader;
        $this->passwordHandler = $passwordHandler;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Business\Exception\AuthentificationException
     */
    public function login(string $username, string $password): UserDataProvider
    {
        $userDataProvider = new UserDataProvider();
        $userDataProvider->setEmail($username);
        $userDataProvider = $this->userReader->getUser($userDataProvider);

        if (
            $userDataProvider->hasUserId()
            && !$this->passwordHandler->validate($userDataProvider, $password)
        ) {
            throw new AuthentificationException(
                sprintf(
                    'Login with user %s failed',
                    $username
                )
            );
        }

        $this->userSession->loginUser($userDataProvider);

        return $userDataProvider;
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function loginWithoutAuthentification(UserDataProvider $userDataProvider): UserDataProvider
    {
        $this->userSession->loginUser($userDataProvider);

        return $userDataProvider;
    }
}