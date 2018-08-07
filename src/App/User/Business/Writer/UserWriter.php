<?php
declare(strict_types=1);

namespace App\User\Business\Writer;


use App\User\Business\Password\PasswordHandlerInterface;
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
     * @var \App\User\Business\Password\PasswordHandlerInterface
     */
    private $passwordHandler;

    /**
     * UserWriter constructor.
     *
     * @param \App\User\UserQueryContainer $queryContainer
     * @param \App\User\Business\Password\PasswordHandlerInterface $passwordHandler
     */
    public function __construct(
        UserQueryContainer $queryContainer,
        PasswordHandlerInterface $passwordHandler
    ) {
        $this->queryContainer = $queryContainer;
        $this->passwordHandler = $passwordHandler;
    }


    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @param bool $overwrite
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function writeUser(UserDataProvider $userDataProvider, bool $overwrite): UserDataProvider
    {
        $user = $this->getUserFromDataProvider($userDataProvider);

        if (!$user) {
            $user = new UserEntity();
        } elseif (!$overwrite) {
            return $userDataProvider;
        }

        $userDataProvider = $this->passwordHandler->encrypt($userDataProvider);

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