<?php
namespace App\Service;
use Psr\Log\LoggerInterface;
class MessageGenerator
{
    private $logger;
    public function __construct(LoggerInterface $loggger)
    {
        $this->logger=$loggger;
    }
    public function getHappyMessage(): string
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $this->logger->info("this is message loggger");

        $index = array_rand($messages);

        return $messages[$index];
    }
}