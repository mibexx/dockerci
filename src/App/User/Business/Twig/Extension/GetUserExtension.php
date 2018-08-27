<?php


namespace App\User\Business\Twig\Extension;


use Xervice\Core\Business\Model\Locator\Dynamic\Business\DynamicBusinessLocator;

/**
 * @method \Xervice\User\Business\UserFacade getFacade()
 */
class GetUserExtension extends \Twig_Extension
{
    use DynamicBusinessLocator;

    private const FUNCTION_NAME = 'getUser';

    /**
     * @return array|\Twig_Function[]
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