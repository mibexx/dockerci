<?php
declare(strict_types=1);

namespace App\User\Business\Writer;


use App\User\UserQueryContainer;
use DataProvider\UserDataProvider;
use Orm\App\User\Persistence\User as UserEntity;

class UserWriter implements UserWriterInterface
{
    /**
     * @var \App\User\UserQueryContainer
     */
    private $queryContainer;

    /**
     * UserWriter constructor.
     *
     * @param \App\User\UserQueryContainer $queryContainer
     */
    public function __construct(UserQueryContainer $queryContainer)
    {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function writeUser(UserDataProvider $userDataProvider): UserDataProvider
    {
        $user = $this->getUserFromDataProvider($userDataProvider);

        if (!$user) {
            $user = new UserEntity();
        }

        $user->fromArray($userDataProvider->toArray());
        $user->save();

        $userDataProvider->fromArray($user->toArray());

        return $userDataProvider;
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteUser(UserDataProvider $userDataProvider): void
    {
        $user = $this->getUserFromDataProvider($userDataProvider);

        if ($user) {
            $user->delete();
        }
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \Orm\App\User\Persistence\User
     */
    protected function getUserFromDataProvider(UserDataProvider $userDataProvider): ?UserEntity
    {
        if ($userDataProvider->hasUserId()) {
            $user = $this->queryContainer->findById($userDataProvider->getUserId());
        } else {
            $user = $this->queryContainer->findByEmail($userDataProvider->getEmail());
        }

        return $user->findOne();
    }
}