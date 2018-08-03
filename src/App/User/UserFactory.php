<?php
declare(strict_types=1);

namespace App\User;


use App\User\Business\Authenticator\UserAuthenticator;
use App\User\Business\Authenticator\UserAuthenticatorInterface;
use App\User\Business\Password\PasswordHandler;
use App\User\Business\Password\PasswordHandlerInterface;
use App\User\Business\Reader\UserReader;
use App\User\Business\Reader\UserReaderInterface;
use App\User\Business\UserSession\UserSession;
use App\User\Business\UserSession\UserSessionInterface;
use App\User\Business\Writer\UserWriter;
use App\User\Business\Writer\UserWriterInterface;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Session\SessionClient;

/**
 * @method \App\User\UserConfig getConfig()
 */
class UserFactory extends AbstractFactory
{
    /**
     * @return \App\User\Business\Authenticator\UserAuthenticatorInterface
     */
    public function createUserAuthenticator(): UserAuthenticatorInterface
    {
        return new UserAuthenticator(
            $this->createUserSession(),
            $this->createUserReader(),
            $this->createPasswordHandler()
        );
    }

    /**
     * @return \App\User\Business\UserSession\UserSessionInterface
     */
    public function createUserSession(): UserSessionInterface
    {
        return new UserSession(
            $this->getSessionClient()
        );
    }

    /**
     * @return \App\User\Business\Password\PasswordHandlerInterface
     */
    public function createPasswordHandler(): PasswordHandlerInterface
    {
        return new PasswordHandler();
    }

    /**
     * @return \App\User\Business\Writer\UserWriterInterface
     */
    public function createUserWriter(): UserWriterInterface
    {
        return new UserWriter(
            $this->getQueryContainer(),
            $this->createPasswordHandler()
        );
    }

    /**
     * @return \App\User\Business\Reader\UserReaderInterface
     */
    public function createUserReader(): UserReaderInterface
    {
        return new UserReader(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Xervice\Session\SessionClient
     */
    public function getSessionClient(): SessionClient
    {
        return $this->getDependency(UserDependencyProvider::SESSION_CLIENT);
    }
    
    /**
     * @return \App\User\UserQueryContainer
     */
    public function getQueryContainer(): UserQueryContainer
    {
        return $this->getDependency(UserDependencyProvider::USER_QUERY);
    }
}