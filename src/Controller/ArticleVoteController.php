<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleVoteController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param string $type
     * @Route("/articles/{slug}/vote/{type<up|down>}", name="app_article_vote", methods={"POST"})
     */
    public function like(Article $article, string $type, LoggerInterface $logger, EntityManagerInterface $em) 
    {
        if ($type == 'up') {
            $article->voteUp();
            $logger->info("Статья: {$article->getId()} - up");
        } else {
            $article->voteDown();
            $logger->info("Статья: {$article->getId()} - down");
        }

        $em->flush($article);

        return $this->json(['vote' => $article->getVoteCount()]);
    }
}