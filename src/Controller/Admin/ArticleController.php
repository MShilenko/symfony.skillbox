<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function create()
    {
        return new Response("Страница создания  статьи");
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
