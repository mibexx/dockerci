<?php
declare(strict_types=1);

namespace App\Twig;


use App\Twig\Extension\TwigDefaultExtensions;
use App\User\Business\Twig\UserTwigExtension;
use Xervice\Atomic\Business\Twig\AtomicTwigExtension;
use Xervice\Twig\TwigDependencyProvider as XerviceTwigDependencyProvider;

class TwigDependencyProvider extends XerviceTwigDependencyProvider
{
    /**
     * @return \Xervice\Twig\Business\Twig\Extensions\TwigExtensionInterface[]
     */
    protected function getTwigExtensions(): array
    {
        return [
            new TwigDefaultExtensions(),
            new AtomicTwigExtension(),
            new UserTwigExtension()
        ];
    }

}