<?php
declare(strict_types=1);

namespace App\Web;


use App\Application\Plugins\Routing\Routing;
use Xervice\Web\WebDependencyProvider as XerviceWebDependencyProvider;

class WebDependencyProvider extends XerviceWebDependencyProvider
{
    /**
     * @return \Xervice\Web\Business\Plugin\WebProviderPluginInterface[]
     */
    protected function getRouteProvider(): array
    {
        return [
            new Routing()
        ];
    }
}