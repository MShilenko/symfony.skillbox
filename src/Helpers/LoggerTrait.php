<?php

namespace App\Helpers;

use Psr\Log\LoggerInterface;

trait LoggerTrait
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param LoggerInterface $logger
     * @required
     * @return void
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logInfo(string $message, array $context)
    {
        if ($this->logger) {
            $this->logger->info($message, $context);
        }
    }
}