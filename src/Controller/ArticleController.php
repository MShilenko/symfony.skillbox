<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use Psr\Log\LoggerInterface;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use App\Homework\ArticleContentProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $articles = $articleRepository->findLatestPublished();
        $lastComments = $commentRepository->findLatestWithLimit(3);

        return $this->render('articles/index.html.twig', compact('articles', 'lastComments'));
    }

    /**
     * @Route("/articles/article_content", methods={"GET"}, name="app_article_text_generate")
     */
    public function articleGenerate(Request $request, ArticleContentProviderInterface $provider)
    {
        $content = '';

        if ($request->query->has('paragraphs')) {
            $paragraphs = (int) $request->query->get('paragraphs');
            $word = (string) $request->query->get('word') ?? null;
            $wordCount = (int) $request->query->get('wordCount') ?? 0;
            $content = $provider->get($paragraphs, $word, $wordCount);
        }

        return $this->render('articles/generate.html.twig', compact('content'));
    }

    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */
    public function show(string $slug, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->getArticleWithComments($slug);

        return $this->render('articles/show.html.twig', compact('article'));
    }

    /**
     * @Route("/api/v1/article_content/", methods={"GET"})
     */
    public function apiShow(
        Request $request,
        ArticleContentProviderInterface $provider,
        Security $security,
        LoggerInterface $apiLogger
    ) {
        /** @var $user User */
        $user = $security->getUser();

        if ($this->isGranted('ROLE_API')) {
            $apiLogger->warning('Попытка входа в раздел API', ['User' => $user ? $user->getFirstName() : 'Аноним']);
            throw new \Exception('Доступ запрещен!');
        }

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
