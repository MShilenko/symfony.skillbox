<?php

namespace App\Twig;

use App\Service\MarkdownParser;
use Carbon\Carbon;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    /** @var MarkdownParser $markdownParser */
    private $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parseMarkdown($content)
    {
        return $this->markdownParser->parse($content);
    }

    public function getDiff($value)
    {
        return (new Carbon($value))->locale('ru')->diffForHumans();
    }
}
