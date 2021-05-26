<?php

namespace App\Homework;

use Faker\Factory as Faker;
use Demontpx\ParsedownBundle\Parsedown;

class TextGenerator
{
    /** @var Parsedown $parser */
    private $parser;

    /** @var string $markArticle */
    private $markArticle;

    /** @var Faker\Generator $faker */
    private $faker;

    public function __construct(Parsedown $parser, string $markArticle)
    {
        $this->parser = $parser;
        $this->markArticle = $markArticle ?? 'bold';
        $this->faker = Faker::create();
    }

    /**
     * Генератор фейкового текста
     *
     * @param integer $paragraphs
     * @param string $word
     * @param integer $wordsCount
     * @return string
     */
    public function generate(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $text = $this->faker->paragraphs($paragraphs, true);

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
    protected function addWordIntoString(string $text, string $word, int $wordsCount): string
    {
        $arr = str_split($text);
        $spaces = $this->getSpaces($arr);
        $mark = $this->getMark();

        for ($i = 0; $i < $wordsCount; $i++) {
            $arr[$spaces[rand(0, count($spaces) - 1)]] = " {$mark}{$word}{$mark} ";
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
