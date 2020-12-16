<?php

namespace App\Homework;

use Demontpx\ParsedownBundle\Parsedown;
use Faker\Factory as Faker;

class ArticleProvider implements ArticleContentProviderInterface
{
    /** @var Parsedown $parser */
    private $parser;
    
    /** @var string $markArticle */
    private $markArticle;

    public function __construct(Parsedown $parser, string $markArticle)
    {
        $this->parser = $parser;
        $this->markArticle = $markArticle;
    }

    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $faker = Faker::create();
        $text = $faker->paragraphs($paragraphs, true);

        if ($word) {
            $text = $this->addWordIntoString($text, $word, $wordsCount);
        }

        return $this->parser->parse($text);
    }

    /**
     * Добавляем переданное слово
     *
     * @param string $text
     * @param string $word
     * @param integer $wordsCount
     * @return string
     */
    private function addWordIntoString(string $text, string $word, int $wordsCount): string
    {
        $arr = str_split($text);
        $spaces = $this->getSpaces($arr);
        $mark = $this->getMark();

        // dd(rand(0, count($spaces)), count($spaces));

        for ($i = 0; $i < $wordsCount; $i++) {
            $arr[$spaces[rand(0, count($spaces))]] = " {$mark}{$word}{$mark} ";
        }

        $text = implode('', $arr);

        return $text;
    }

    /**
     * Устанавливаем символы оформления
     *
     * @return string
     */
    private function getMark(): string
    {
        switch ($this->markArticle) {
            case 'bold':
                $mark = '**';
                break;

            case 'italic':
                $mark = '*';
                break;

            default:
                $mark = '';
                break;
        }

        return $mark;
    }

    /**
     * Собираем индексы всех пробелов в строке
     *
     * @param array $arr
     * @return array
     */
    private function getSpaces(array $arr): array
    {
        $spaces = [];

        foreach ($arr as $key => $value) {
            if ($value === ' ') {
                $spaces[] = $key;
            }
        }

        return $spaces;
    }
}
