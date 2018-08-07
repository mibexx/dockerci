<?php


namespace App\Twig\Extension;


use Xervice\Twig\Business\Twig\Extensions\TwigExtensionInterface;

class TwigDefaultExtensions implements TwigExtensionInterface
{
    public function register(\Twig_Environment $environment): \Twig_Environment
    {
        $environment->addExtension(
            new \Twig_Extension_Debug()
        );

        return $environment;
    }
}