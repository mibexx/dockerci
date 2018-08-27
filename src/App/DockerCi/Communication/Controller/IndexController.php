<?php


namespace App\DockerCi\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \App\DockerCi\Communication\DockerCiCommunicationFactory getFactory()
 */
class IndexController extends AbstractTwigController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Xervice\Core\Business\Exception\ServiceNotFoundException
     */
    public function indexAction(Request $request): Response
    {
        return ($this->getFactory()->getUserFacade()->getLoggedUser())
            ? $this->getRedirectToDashboard()
            : $this->sendTwig(
                'pages/index.twig',
                [
                    'error' => $request->query->has('error') ? $request->query->get('error') : ''
                ]
            );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getRedirectToDashboard(): RedirectResponse
    {
        return new RedirectResponse('/dashboard');
    }
}