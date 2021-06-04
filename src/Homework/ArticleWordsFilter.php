<?php

namespace App\Homework;

class ArticleWordsFilter implements ArticleWordsFilterInterface
{
    public function filter(string $string, array $words = []): string
    {
        $list = explode(' ', $string);
        $result = array_filter($list, function ($a) use ($words) {
            foreach ($words as $word) {
                if (mb_stripos($a, $word) !== false) {
                    return false;
                }
            }

            return true;
        });

        return implode(' ', $result);
    }
}
