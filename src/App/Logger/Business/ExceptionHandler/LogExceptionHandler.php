<?php
declare(strict_types=1);

namespace App\Logger\Business\ExceptionHandler;


use DataProvider\LogMessageDataProvider;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface;

/**
 * @method \Xervice\Logger\LoggerFacade getFacade()
 */
class LogExceptionHandler extends AbstractWithLocator implements ExceptionHandlerInterface
{
    /**
     * @param \Throwable $exception
     * @param bool $isDebug
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function handleException(\Throwable $exception, bool $isDebug): void
    {
        $logMessage = new LogMessageDataProvider();
        $logMessage
            ->setTitle(get_class($exception))
            ->setMessage($exception->getMessage())
            ->setContext($exception->getTraceAsString());

        $this->getFacade()->log($logMessage);
    }
}