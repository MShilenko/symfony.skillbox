<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleLikeController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param string $type
     * @Route("/articles/{slug}/like/{type<like|dislike>}", name="app_article_like", methods={"POST"})
     */
    public function like(Article $article, string $type, LoggerInterface $logger, EntityManagerInterface $em) 
    {
        if ($type == 'like') {
            $article->like();
            $logger->info("Статья: {$article->getId()} - like");
        } else {
            $article->dislike();
            $logger->info("Статья: {$article->getId()} - dislike");
        }

        $em->flush($article);

        return $this->json(['likes' => $article->getLikeCount()]);
    }
}