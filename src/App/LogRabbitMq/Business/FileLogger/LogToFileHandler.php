<?php


namespace App\LogRabbitMq\Business\FileLogger;


use DataProvider\LogMessageDataProvider;

class LogToFileHandler implements LogToFileHandlerInterface
{
    /**
     * @var string
     */
    private $queueName;

    /**
     * @var string
     */
    private $logFile;

    /**
     * LogToFileHandler constructor.
     *
     * @param string $queueName
     */
    public function __construct(string $queueName, string $logFile)
    {
        $this->queueName = $queueName;
        $this->logFile = $logFile;
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * @param \DataProvider\LogMessageDataProvider $messageDataProvider
     */
    public function handleLog(LogMessageDataProvider $messageDataProvider): void
    {
        if (!is_file($this->logFile)) {
            touch($this->logFile);
        }

        $message = $messageDataProvider->getTitle()
                   . PHP_EOL
                   . $messageDataProvider->getMessage()
                   . PHP_EOL
                   . PHP_EOL
                   . $messageDataProvider->getContext()
                   . PHP_EOL
                   . '----------------------------------'
                   . PHP_EOL;

        file_put_contents($this->logFile, $message, FILE_APPEND);
    }
}