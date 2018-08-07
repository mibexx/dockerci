<?php


namespace App\GithubAuth;


use App\GithubAuth\Business\User\UserWriter;
use App\GithubAuth\Business\User\UserWriterInterface;
use App\User\UserFacade;
use Xervice\GithubAuth\GithubAuthFactory as XerviceGithubAuthFactory;

class GithubAuthFactory extends XerviceGithubAuthFactory
{
    /**
     * @return \App\GithubAuth\Business\User\UserWriter
     */
    public function createGithubUserWriter(): UserWriterInterface
    {
        return new UserWriter(
            $this->getUserFacade(),
            $this->createGithubClient()
        );
    }

    /**
     * @return \App\User\UserFacade
     */
    public function getUserFacade(): UserFacade
    {
        return $this->getDependency(GithubAuthDependencyProvider::USER_FACADE);
    }
}