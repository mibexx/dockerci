<?php


namespace App\User;


use Xervice\GithubAuth\Business\Model\User\GithubLogin;
use Xervice\User\Business\Model\Authenticator\Login\DefaultLogin;
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