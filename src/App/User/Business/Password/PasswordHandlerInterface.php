<?php

namespace App\User\Business\Password;

use DataProvider\UserDataProvider;

interface PasswordHandlerInterface
{
    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function encrypt(UserDataProvider $userDataProvider): UserDataProvider;

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return bool
     */
    public function validate(UserDataProvider $userDataProvider, string $password): bool;
}