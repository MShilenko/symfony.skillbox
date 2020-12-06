<?php

namespace App\Service;

use App\Helpers\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    /** @var Client $client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;       
    }

    public function send(string $messageText, string $from = 'Symfony.project', string $icon = ':ghost:')
    {
        $this->logInfo('Отправка сообщения в Slack', ['message' => $messageText]);

        $message = $this->client->createMessage();

        $message
            ->from($from)
            ->withIcon($icon)
            ->setText($messageText)
        ;

        $this->client->sendMessage($message);
    }
}