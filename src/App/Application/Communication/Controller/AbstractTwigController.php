<?php
declare(strict_types=1);

namespace App\Application\Communication\Controller;


use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Communication\Controller\AbstractController;
use Xervice\Kernel\Business\Plugin\ClearServiceInterface;

class AbstractTwigController extends AbstractController
{
    /**
     * @return \Xervice\Twig\Business\Kernel\TwigService
     */
    public function getTwig(): ClearServiceInterface
    {
        return $this->getService('twig');
    }

    /**
     * @param string $template
     * @param array $params
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Xervice\Core\Business\Exception\ServiceNotFoundException
     */
    public function sendTwig(string $template, array $params = []): Response
    {
        return $this->sendResponse(
            $this->getTwig()->render(
                '@' . $this->getServiceName() . '/' . $template,
                $params
            )
        );
    }
}