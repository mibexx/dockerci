<?php
declare(strict_types=1);

namespace App\User\Business\Reader;


use App\User\UserQueryContainer;
use DataProvider\UserDataProvider;
use Orm\App\User\Persistence\User;

class UserReader implements UserReaderInterface
{
    /**
     * @var \App\User\UserQueryContainer
     */
    private $queryContainer;

    /**
     * UserReader constructor.
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
     */
    public function getUser(UserDataProvider $userDataProvider): UserDataProvider
    {
        $user = $this->getUserFromDataProvider($userDataProvider);
        if ($user) {
            $userDataProvider->fromArray($user->toArray());
        }

        return $userDataProvider;
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \Orm\App\User\Persistence\User
     */
    protected function getUserFromDataProvider(UserDataProvider $userDataProvider): ?User
    {
        if ($userDataProvider->hasUserId()) {
            $user = $this->queryContainer->findById($userDataProvider->getUserId());
        } else {
            $user = $this->queryContainer->findByEmail($userDataProvider->getEmail());
        }

        return $user->findOne();
    }

}