<?php
declare(strict_types=1);

namespace App\User;


use DataProvider\UserDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \App\User\UserFactory getFactory()
 */
class UserFacade extends AbstractFacade
{
    public function logout(): void
    {
        $this->getFactory()->createUserSession()->logoutUser();
    }

    /**
     * @return \DataProvider\UserDataProvider|null
     */
    public function getUser(): ?UserDataProvider
    {
        return $this->getFactory()->createUserSession()->getLoggedUser();
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Business\Exception\AuthentificationException
     */
    public function loginUser(string $username, string $password): UserDataProvider
    {
        return $this->getFactory()->createUserAuthenticator()->login($username, $password);
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function loginUserWithoutAuthentification(UserDataProvider $userDataProvider): UserDataProvider
    {
        return $this->getFactory()->createUserAuthenticator()->loginWithoutAuthentification($userDataProvider);
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function saveUser(UserDataProvider $userDataProvider): UserDataProvider
    {
        return $this->getFactory()->createUserWriter()->writeUser($userDataProvider);
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteUser(UserDataProvider $userDataProvider): void
    {
        $this->getFactory()->createUserWriter()->deleteUser($userDataProvider);
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function getUserFromDb(UserDataProvider $userDataProvider): UserDataProvider
    {
        return $this->getFactory()->createUserReader()->getUser($userDataProvider);
    }
}