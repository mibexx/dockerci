<?php
declare(strict_types=1);

namespace App\Xervice\Business\ExceptionRegister;


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xervice\ExceptionHandler\Business\Model\Register\RegisterInterface;

class WhoopsExceptionHandler implements RegisterInterface
{
    /**
     * @param bool $isDebug
     */
    public function register(bool $isDebug): void
    {
        if ($isDebug) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
        }
    }

}