<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     * @Route("/admin/articles", name="app_admin_articles")
     */
    public function index(ArticleRepository $articleRepository, Request $request, PaginatorInterface $paginator)
    {
        $request->query->set('onPage', $request->query->get('onPage') ?? 20);
        $pagination = $paginator->paginate(
            $articleRepository->findAllWithSearchQuery($request->query->get('q')),
            $request->query->getInt('page', 1),
            (int) $request->query->get('onPage')
        );

        return $this->render('admin/article/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $article->setPublishedAt(new DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('flash_message', 'Статья успешно создана');

            return $this->redirectToRoute('app_admin_articles');
        }

        return $this->render('admin/article/create.html.twig', ['articleForm' => $form->createView()]);
    }

    /**
     * @Route("/admin/articles/{id}/edit", name="app_admin_articles_edit")
     * @IsGranted("MANAGE", subject="article")
     */
    public function edit(Article $article)
    {
        return new Response("Страница редактирования статьи {$article->getTitle()}");
    }
}
