<?php
declare(strict_types=1);

namespace App\User;


use DataProvider\UserDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \App\User\UserFactory getFactory()
 * @method \App\User\UserConfig getConfig()
 * @method \App\User\UserClient getClient()
 */
class UserFacade extends AbstractFacade
{
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
    public function getUser(UserDataProvider $userDataProvider): UserDataProvider
    {
        return $this->getFactory()->createUserReader()->getUser($userDataProvider);
    }
}