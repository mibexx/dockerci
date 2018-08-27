<?php


namespace App\DockerCi;

use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;

class DockerCiDependencyProvider extends AbstractDependencyProvider
{
    public const USER_FACADE = 'user.facade';

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[self::USER_FACADE] = function (DependencyContainerInterface $container) {
            return $container->getLocator()->user()->facade();
        };

        return $container;
    }
}