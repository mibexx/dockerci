<?php


namespace App\User;


use Xervice\GithubAuth\Business\User\GithubLogin;
use Xervice\User\Business\Authenticator\Login\DefaultLogin;
use Xervice\User\UserDependencyProvider as XerviceUserDependencyProvider;

class UserDependencyProvider extends XerviceUserDependencyProvider
{
    protected function getLoginPluginList(): array
    {
        return [
            'Default' => new DefaultLogin(),
            'Github'  => new GithubLogin()
        ];
    }

}