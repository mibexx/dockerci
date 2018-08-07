<?php

namespace App\User\Business\Authenticator;

use DataProvider\UserDataProvider;

interface UserAuthenticatorInterface
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Business\Exception\AuthentificationException
     */
    public function login(string $username, string $password): UserDataProvider;

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function loginWithoutAuthentification(UserDataProvider $userDataProvider): UserDataProvider;
}