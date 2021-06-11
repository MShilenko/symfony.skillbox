<?php

namespace App\EventSubscriber;

use App\Service\Mailer;
use App\Events\ArticleCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ArticleCreatedSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    public function __construct(Mailer $mailer, ContainerBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->params = $params;
    }

    public function onArticleCreated(ArticleCreatedEvent $event)
    {
        $article = $event->getArticle();
        $author = $article->getAuthor();

        if ($author->getEmail() != $this->params->get('app.admin_email')) {
            $this->mailer->sendArticleCreated($article);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            ArticleCreatedEvent::class => 'onArticleCreated',
        ];
    }
}
