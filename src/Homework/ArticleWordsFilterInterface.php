<?php

namespace App\Homework;

interface ArticleWordsFilterInterface
{
    public function filter(string $string, array $words = []): string;
}