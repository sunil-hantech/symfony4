<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $cache;
    private $markdown;
    private $logger;
    private $isDebug;
    // public function __construct(AdapterInterface $cache, MarkdownInterfacenterface $markdown,LoggerInterfaceace $logger)
    public function __construct(AdapterInterface $cache, MarkdownParserInterface $markdown,LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
    }

    public function parse(string $source): string
    {


        if (stripos($source, 'bacon') !== false) {
            $this->logger->info('They are talking about bacon again!!!');
        }

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }
        
        if ($this->isDebug) {
            return $this->markdown->transform($source);
        }
        return $item->get();

    }
}
