<?php

namespace App\Service;

use Demontpx\ParsedownBundle\Parsedown;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Security\Core\Security;

class MarkdownParser
{
    /** @var Parsedown $parsedown */
    private $parsedown;

    /** @var AdapterInterface $cache */
    private $cache;

    /** @var LoggerInterface $logger */
    private $logger;

    /** @var Security $security */
    private $security;

    /** @var boolean $debug */
    private $debug;


    public function __construct(
        Parsedown $parsedown,
        AdapterInterface $cache,
        LoggerInterface $markdownLogger,
        Security $security,
        bool $debug
    ) {
        $this->parsedown = $parsedown;
        $this->cache = $cache;
        $this->logger = $markdownLogger;
        $this->security = $security;
        $this->debug = $debug;
    }

    public function parse(string $source): string
    {
        $user = $this->security->getUser();
        
        if ($user) {
            $this->logger->info("User {$user->getUsername()} use cache: markdown_{md5($source)}");
        } else {
            $this->logger->info("Use cache: markdown_{md5($source)}");
        }

        if ($this->debug) {
            return $this->parsedown->text($source);
        }

        return $this->cache->getItem('markdown_' . md5($source), function () use ($source) {
            return $this->parsedown->text($source);
        });
    }
}
