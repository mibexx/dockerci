<?php


namespace App\DockerCi\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Xervice\Core\Factory\FactoryInterface;

/**
 * @method \App\DockerCi\DockerCiFactory getFactory()
 */
class IndexController extends AbstractTwigController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(): Response
    {
        return ($this->getFactory()->getUserFacade()->getUser())
            ? $this->getRedirectToDashboard()
                : $this->sendTwig('pages/index.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getRedirectToDashboard(): RedirectResponse
    {
        return new RedirectResponse('/dashboard');
    }
}