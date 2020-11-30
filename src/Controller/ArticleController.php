<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index() 
    {
        return $this->render('articles/index.html.twig');
    }

    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */
    public function show(string $slug) 
    {
        $comments = [
            'test1',
            'test2',
            'test3',
            'test4',
            'test5',
        ];

        return $this->render('articles/show.html.twig', ['article' => $slug, 'comments' => $comments]);
    }
}