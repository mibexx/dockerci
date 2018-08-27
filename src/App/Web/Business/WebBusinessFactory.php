<?php
declare(strict_types=1);

namespace App\Web\Business;


use Xervice\Controller\Business\Model\ResponseHandler\ControllerResponseHandler;
use Xervice\Web\Business\Model\Executor\ResponseHandler\ResponseHandlerInterface;
use Xervice\Web\Business\WebBusinessFactory as XerviceWebBusinessFactory;

class WebBusinessFactory extends XerviceWebBusinessFactory
{
    /**
     * @return \Xervice\Web\Business\Model\Executor\ResponseHandler\ResponseHandlerInterface
     */
    public function createResponseHandler(): ResponseHandlerInterface
    {
        return new ControllerResponseHandler();
    }
}