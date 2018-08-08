<?php


namespace App\DockerCi;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\User\UserFacade;

class DockerCiFactory extends AbstractFactory
{
    /**
     * @return \Xervice\User\UserFacade
     */
    public function getUserFacade(): UserFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::USER_FACADE);
    }
}