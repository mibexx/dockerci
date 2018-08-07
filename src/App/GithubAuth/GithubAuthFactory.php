<?php


namespace App\GithubAuth;


use App\User\UserFacade;
use Xervice\GithubAuth\GithubAuthFactory as XerviceGithubAuthFactory;

class GithubAuthFactory extends XerviceGithubAuthFactory
{
    public function createGithubUserWriter()
    {

    }

    /**
     * @return \App\User\UserFacade
     */
    public function getUserFacade(): UserFacade
    {
        return $this->getDependency(GithubAuthDependencyProvider::USER_FACADE);
    }
}