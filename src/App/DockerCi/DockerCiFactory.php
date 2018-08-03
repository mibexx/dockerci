<?php


namespace App\DockerCi;


use App\User\UserFacade;
use Xervice\Core\Factory\AbstractFactory;

class DockerCiFactory extends AbstractFactory
{
    /**
     * @return \App\User\UserFacade
     */
    public function getUserFacade(): UserFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::USER_FACADE);
    }
}