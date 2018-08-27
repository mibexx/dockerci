<?php


namespace App\DockerCi\Communication;


use Xervice\Core\Business\Model\Factory\AbstractCommunicationFactory;
use Xervice\User\Business\UserFacade;

class DockerCiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Xervice\User\Business\UserFacade
     */
    public function getUserFacade(): UserFacade
    {
        return $this->getDependency(DockerCiDependencyProvider::USER_FACADE);
    }
}