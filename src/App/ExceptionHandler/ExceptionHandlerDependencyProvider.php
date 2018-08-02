<?php
declare(strict_types=1);

namespace App\ExceptionHandler;


use App\ExceptionHandler\Business\ExceptionHandler\DebugExceptionHandler;
use App\Logger\Business\ExceptionHandler\LogExceptionHandler;
use App\Xervice\Business\ExceptionRegister\WhoopsExceptionHandler;
use Xervice\ExceptionHandler\Business\Register\Register\ExceptionHandlerRegister;
use Xervice\ExceptionHandler\ExceptionHandlerDependencyProvider as XerviceExceptionHandlerDependencyProvider;

class ExceptionHandlerDependencyProvider extends XerviceExceptionHandlerDependencyProvider
{
    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface[]
     */
    public function getExceptionHandler(): array
    {
        return [
            new LogExceptionHandler()
        ];
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Register\RegisterInterface[]
     */
    public function getExceptionRegister(): array
    {
        return [
            new ExceptionHandlerRegister(),
            new WhoopsExceptionHandler()
        ];
    }
}