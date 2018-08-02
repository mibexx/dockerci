<?php


namespace App\DockerCi\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->sendTwig('pages/index.twig');
    }
}