<?php

namespace App\Homework;

use Demontpx\ParsedownBundle\Parsedown;


class ArticleProvider implements ArticleContentProviderInterface
{
    /** @var TextGenerator $textGenerator */
    private $textGenerator;

    public function __construct(Parsedown $parser, string $markArticle)
    {
        $this->textGenerator = new TextGenerator($parser, $markArticle);
    }

    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        return $this->textGenerator->generate($paragraphs, $word, $wordsCount);
    }
}
