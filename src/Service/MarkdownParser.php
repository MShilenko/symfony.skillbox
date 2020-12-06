<?php

namespace App\Service;

use Demontpx\ParsedownBundle\Parsedown;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownParser
{
    /** @var Parsedown $parsedown */
    private $parsedown;

    /** @var AdapterInterface $cache */
    private $cache;

    /** @var LoggerInterface $logger */
    private $logger;
    
    /** @var boolean $debug */
    private $debug;


    public function __construct(
        Parsedown $parsedown,
        AdapterInterface $cache,
        LoggerInterface $markdownLogger,
        bool $debug
    ) {
        $this->parsedown = $parsedown;
        $this->cache = $cache;
        $this->logger = $markdownLogger;
        $this->debug = $debug;
    }

    public function parse(string $source): string
    {
        $this->logger->info('Use cache: markdown_' . md5($source));

        if ($this->debug) {
            return $this->parsedown->text($source);
        }

        return $this->cache->get('markdown_' . md5($source), function () use ($source) {
            return $this->parsedown->text($source);
        });
    }
}
