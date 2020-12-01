<?php

namespace App\Homework;

class ArticleProvider
{
    private $articles;

    public function __construct()
    {   
        $this->articles = [
            0 => [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'what-do',
                'image' => 'images/article-2.jpeg',
            ],
            1 => [
                'title' => 'Facebook ест твои данные',
                'slug' => 'facebook',
                'image' => 'images/article-1.jpeg',
            ],
            2 => [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'cofeeee',
                'image' => 'images/article-3.jpg',
            ],
            3 => [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'what-do2',
                'image' => 'images/article-2.jpeg',
            ],
            4 => [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'cofeeee2',
                'image' => 'images/article-3.jpg',
            ],
        ];
    }

    public function articles(): array
    {
        return $this->articles;
    }

    public function article(): array
    {
        $rand_key = array_rand($this->articles);
        
        return $this->articles[$rand_key];
    }
}