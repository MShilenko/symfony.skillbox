<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Homework\ArticleContentProviderInterface;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(ArticleRepository $repository) 
    {
        $articles = $repository->findLatestPublished();

        return $this->render('articles/index.html.twig', compact('articles'));
    }

    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */
    public function show(Article $article) 

    {
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