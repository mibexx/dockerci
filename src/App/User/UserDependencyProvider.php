<?php
declare(strict_types=1);

namespace App\User;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class UserDependencyProvider extends AbstractProvider
{
    public const USER_QUERY = 'user.query';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::USER_QUERY] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->user()->queryContainer();
        };
    }
}