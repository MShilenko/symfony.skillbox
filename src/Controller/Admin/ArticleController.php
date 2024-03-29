<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Article;
use App\Events\ArticleCreatedEvent;
use App\Form\ArticleFormType;
use App\Service\FileUploader;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
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
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     */
    public function create(EntityManagerInterface $em, Request $request, FileUploader $articleFileUploader, EventDispatcherInterface $eventDispatcher)
    {
        $form = $this->createForm(ArticleFormType::class, new Article());

        if ($article = $this->handleFormRequest($form, $em, $request, $articleFileUploader)) {

            $this->addFlash('flash_message', 'Статья успешно создана');

            $eventDispatcher->dispatch(new ArticleCreatedEvent($article));

            return $this->redirectToRoute('app_admin_articles');
        }

        return $this->render('admin/article/create.html.twig', [
            'articleForm' => $form->createView(),
            'showError' => $form->isSubmitted(),
        ]);
    }

    /**
     * @Route("/admin/articles/{id}/edit", name="app_admin_article_edit")
     * @IsGranted("MANAGE", subject="article")
     */
    public function edit(Article $article, EntityManagerInterface $em, Request $request, FileUploader $articleFileUploader)
    {
        $form = $this->createForm(ArticleFormType::class, $article, ['enable_published_at' => true]);

        if ($article = $this->handleFormRequest($form, $em, $request, $articleFileUploader)) {

            $this->addFlash('flash_message', 'Статья успешно изменена');

            return $this->redirectToRoute('app_admin_article_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'articleForm' => $form->createView(),
            'showError' => $form->isSubmitted(),
        ]);
    }

    private function handleFormRequest(FormInterface $form, EntityManagerInterface $em, Request $request, FileUploader $articleFileUploader)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();

            /** @var UploadedFile|null $image */
            $image = $form->get('image')->getData();
    
            if ($image) {
                $article->setImage($articleFileUploader->uploadFile($image, $article->getImage()));
            }

            $em->persist($article);
            $em->flush();

            return $article;
        }

        return null;
    }
}
