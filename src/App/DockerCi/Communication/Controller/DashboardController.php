<?php


namespace App\DockerCi\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractTwigController
{
    public const INDEX_ROUTE = '/dashboard';

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Xervice\Core\Business\Exception\ServiceNotFoundException
     */
    public function indexAction(): Response
    {
        return $this->sendTwig('pages/dashboard.twig');
    }
}