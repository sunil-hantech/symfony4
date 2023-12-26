<?php

namespace App\Service;

use App\Helper\LoggerTrait as HelperLoggerTrait;
use LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    use HelperLoggerTrait;

    private $slack;
    private $logger;
    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }
    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to Slack!33', [
            'message' => $message
        ]);

        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($message);
    }

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
