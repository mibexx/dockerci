<?php


namespace App\User\Business\Twig;


use App\User\Business\Twig\Extension\GetUserExtension;
use Xervice\Twig\Business\Twig\Extensions\TwigExtensionInterface;

class UserTwigExtension implements TwigExtensionInterface
{
    /**
     * @param \Twig_Environment $environment
     *
     * @return \Twig_Environment
     */
    public function register(\Twig_Environment $environment): \Twig_Environment
    {
        $environment->addExtension(
            new GetUserExtension()
        );

        return $environment;
    }
}