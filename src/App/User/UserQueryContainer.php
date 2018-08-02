<?php
declare(strict_types=1);

namespace App\User;


use Orm\App\User\Persistence\UserQuery;
use Xervice\Core\ServiceClass\XerviceInterface;

class UserQueryContainer implements XerviceInterface
{
    /**
     * @return \Orm\App\User\Persistence\UserQuery
     */
    public function getUserQuery(): UserQuery
    {
        return UserQuery::create();
    }

    /**
     * @param string $email
     *
     * @return \Orm\App\User\Persistence\UserQuery
     */
    public function findByEmail(string $email): UserQuery
    {
        return $this->getUserQuery()->filterByEmail($email);
    }

    /**
     * @param int $userId
     *
     * @return \Orm\App\User\Persistence\UserQuery
     */
    public function findById(int $userId): UserQuery
    {
        return $this->getUserQuery()->filterByUserId($userId);
    }
}