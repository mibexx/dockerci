<?php


namespace App\User\Business\Twig\Extension;


use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \Xervice\User\UserFacade getFacade()
 */
class GetUserExtension extends \Twig_Extension
{
    use DynamicLocator;

    private const FUNCTION_NAME = 'getUser';

    /**
     * @return array|\Twig_Function[]
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                self::FUNCTION_NAME,
                $this->getFacade()->getLoggedUser(),
                [
                    $this,
                    self::FUNCTION_NAME
                ]
            )
        ];
    }
}