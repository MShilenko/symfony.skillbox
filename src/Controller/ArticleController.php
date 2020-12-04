<?php

namespace App\Controller;

use App\Homework\ArticleProvider;
use App\Service\MarkdownParser;
use App\Service\SlackClient;
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
    public function show(string $slug, ArticleProvider $provider, MarkdownParser $parser, SlackClient $slack) 
    {
        $article = $provider->article();
        // Пример корректного(полного) варианта использования кэша
        // $item = $cache->getItem('markdown_' . md5($article['content']));

        // if (!$item->isHit()) {
        //     $item->set($parsedown->text($article['content']));
        //     $cache->save($item);
        // }

        // $article['content'] = $item->get();

        if ($slug == 'slack')
        {
            $slack->send('Важное уведомление!');
        }

        $article['content'] = $parser->parse($article['content']);

        $comments = [
            'comment1' => 'Text comment 1',
            'comment2' => 'Text comment 2',
            'comment3' => 'Text comment 3',
            'comment4' => 'Text comment 4',
            'comment5' => 'Text comment 5',
        ];

        return $this->render('articles/show.html.twig', compact(['article', 'comments']));
    }
}