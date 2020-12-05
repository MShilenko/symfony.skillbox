<?php

namespace App\Controller;

use App\Homework\ArticleContentProviderInterface;
use App\Homework\ArticleProvider;
use App\Service\SlackClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(string $slug, ArticleProvider $provider, SlackClient $slack) 
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

        $words = [
            'Batman',
            'Robin',
            'Superman',
            'Spider-Man',
            'Iron Man',
            'Mario',
        ];

        if (mt_rand(0, 99) < 70) {
            $article['content'] = $provider->get(rand(2, 10), $words[rand(0, count($words) - 1)], rand(2, 10));
        } else {
            $article['content'] = $provider->get(rand(2, 10));
        }

        $comments = [
            'comment1' => 'Text comment 1',
            'comment2' => 'Text comment 2',
            'comment3' => 'Text comment 3',
            'comment4' => 'Text comment 4',
            'comment5' => 'Text comment 5',
        ];

        return $this->render('articles/show.html.twig', compact(['article', 'comments']));
    }

    /**
     * @Route("/api/v1/article_content/", methods={"GET"})
     */
    public function apiShow(Request $request, ArticleContentProviderInterface $provider)
    {   
        $type = $request->headers->get('Accept');
        $response = new JsonResponse();

        if ($type !== 'application/json') {
            return $response->setData(['error' => 'Передайте строку в формате json']); 
        }

        $requestData = json_decode($request->getContent());

        if (!isset($requestData->paragraphs)) {
            return $response->setData(['error' => 'Укажите количество формируемых парагафов']); 
        }

        return $response->setData(['text' => $provider->get($requestData->paragraphs, $requestData->word ?? null, $requestData->wordCount ?? 0)]);
    }
}