<?php

namespace App\Controller;

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
     * @Route("/articles/{id<\d+>}/like/{type<like|dislike>}", name="app_article_like", methods={"POST"})
     */
    public function like(int $id, string $type, LoggerInterface $logger) 
    {
        if ($type == 'like') {
            $likes = rand(121, 200);
            $logger->info("Статья: {$id} - like");
        } else {
            $likes = rand(0, 119);
            $logger->info("Статья: {$id} - dislike");
        }

        return $this->json(['likes' => $likes]);
    }
}