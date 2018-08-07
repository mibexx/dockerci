<?php


namespace App\User\Business\Twig\Extension;


use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \App\User\UserFacade getFacade()
 */
class GetUserExtension extends \Twig_Extension
{
    use DynamicLocator;

    private const FUNCTION_NAME = 'getUser';

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                self::FUNCTION_NAME,
                $this->getFacade()->getUser(),
                [
                    $this,
                    self::FUNCTION_NAME
                ]
            )
        ];
    }
}