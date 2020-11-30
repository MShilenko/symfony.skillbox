<?php

namespace App\Controller;

use App\Homework\ArticleProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(ArticleProvider $provider) 
    {
        $articles = $provider->articles();

        return $this->render('articles/index.html.twig', compact('articles'));
    }

    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */
    public function show(string $slug, ArticleProvider $provider) 
    {
        $article = $provider->article();

        $comments = [
            'comment1' => 'Text comment 1',
            'comment2' => 'Text comment 2',
            'comment3' => 'Text comment 3',
            'comment4' => 'Text comment 4',
            'comment5' => 'Text comment 5',
        ];

        return $this->render('articles/show.html.twig', ['article' => $article, 'comments' => $comments]);
    }
}