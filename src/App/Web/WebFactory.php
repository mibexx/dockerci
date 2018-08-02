<?php
declare(strict_types=1);

namespace App\Web;


use Xervice\Controller\Business\ResponseHandler\ControllerResponseHandler;
use Xervice\Web\Business\Executor\ResponseHandler\ResponseHandlerInterface;
use Xervice\Web\WebFactory as XerviceWebFactory;

class WebFactory extends XerviceWebFactory
{
    /**
     * @return \Xervice\Web\Business\Executor\ResponseHandler\ResponseHandlerInterface
     */
    public function createResponseHandler(): ResponseHandlerInterface
    {
        return new ControllerResponseHandler();
    }

}