<?php

namespace App\User\Business\UserSession;

use DataProvider\UserDataProvider;

interface UserSessionInterface
{
    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     */
    public function loginUser(UserDataProvider $userDataProvider): void;

    public function logoutUser(): void;

    /**
     * @return \DataProvider\UserDataProvider|null
     */
    public function getLoggedUser(): ?UserDataProvider;
}