<?php
declare(strict_types=1);

namespace App\Logger\Communication\Plugin;


use DataProvider\LogMessageDataProvider;
use Xervice\Core\Plugin\AbstractCommunicationPlugin;
use Xervice\ExceptionHandler\Business\Model\Handler\ExceptionHandlerInterface;

/**
 * @method \Xervice\Logger\Business\LoggerFacade getFacade()
 */
class LogExceptionHandler extends AbstractCommunicationPlugin implements ExceptionHandlerInterface
{
    /**
     * @param \Throwable $exception
     * @param bool $isDebug
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