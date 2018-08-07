<?php

namespace App\GithubAuth\Business\User;

use DataProvider\UserDataProvider;

interface UserWriterInterface
{
    /**
     * @param string $accessToken
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addUserFromGithub(string $accessToken): UserDataProvider;
}