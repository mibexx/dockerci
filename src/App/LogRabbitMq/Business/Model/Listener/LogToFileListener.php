<?php


namespace App\LogRabbitMq\Business\Model\Listener;


use DataProvider\RabbitMqMessageCollectionDataProvider;
use PhpAmqpLib\Channel\AMQPChannel;
use Xervice\RabbitMQ\Business\Model\Worker\Listener\AbstractListener;

/**
 * @method \App\LogRabbitMq\LogRabbitMqFactory getFactory()
 */
class LogToFileListener extends AbstractListener
{
    /**
     * @var \App\LogRabbitMq\Business\Model\FileLogger\LogToFileHandlerInterface
     */
    private $logHandler;

    /**
     * LogToFileListener constructor.
     */
    public function __construct()
    {
        $this->logHandler = $this->getFactory()->createLogToFileHandler();
    }

    /**
     * @param \DataProvider\RabbitMqMessageCollectionDataProvider $collectionDataProvider
     * @param \PhpAmqpLib\Channel\AMQPChannel $channel
     */
    public function handleMessage(
        RabbitMqMessageCollectionDataProvider $collectionDataProvider,
        AMQPChannel $channel
    ): void {
        foreach ($collectionDataProvider->getMessages() as $message) {
            $this->logHandler->handleLog($message->getMessage());

            $this->sendAck(
                $channel,
                $message
            );
        };
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->logHandler->getQueueName();
    }

}