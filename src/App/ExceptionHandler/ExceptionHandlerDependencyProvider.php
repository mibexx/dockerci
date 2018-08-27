<?php
declare(strict_types=1);

namespace App\ExceptionHandler;


use App\Logger\Communication\Plugin\LogExceptionHandler;
use App\Xervice\Business\ExceptionRegister\WhoopsExceptionHandler;
use Xervice\ExceptionHandler\Business\Model\Register\Register\ExceptionHandlerRegister;
use Xervice\ExceptionHandler\ExceptionHandlerDependencyProvider as XerviceExceptionHandlerDependencyProvider;

class ExceptionHandlerDependencyProvider extends XerviceExceptionHandlerDependencyProvider
{
    /**
     * @return \Xervice\ExceptionHandler\Business\Model\Handler\ExceptionHandlerInterface[]
     */
    public function getExceptionHandler(): array
    {
        return [
            new LogExceptionHandler()
        ];
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Model\Register\RegisterInterface[]
     */
    public function getExceptionRegister(): array
    {
        return [
            new ExceptionHandlerRegister(),
            new WhoopsExceptionHandler()
        ];
    }
}