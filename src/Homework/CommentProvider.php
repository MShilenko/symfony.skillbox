<?php

namespace App\Homework;

use Demontpx\ParsedownBundle\Parsedown;

class CommentProvider implements CommentContentProviderInterface
{
    /** @var TextGenerator $textGenerator */
    private $textGenerator;

    public function __construct(Parsedown $parser, string $markArticle)
    {
        $this->textGenerator = new TextGenerator($parser, $markArticle);
    }

    public function get(string $word = null, int $wordsCount = 0): string
    {
        return $this->textGenerator->generate(1, $word, $wordsCount);
    }
}