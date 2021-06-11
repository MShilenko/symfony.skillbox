<?php

namespace App\Service;

use Closure;
use App\Entity\User;
use App\Entity\Article;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Mailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    public function __construct(MailerInterface $mailer, ContainerBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->params = $params;
    }

    public function sendWelcomeMail(User $user)
    {
        $this->send('email/welcome.html.twig', 'Добро пожаловать', $user);
    }

    public function sendArticleCreated(Article $article)
    {
        $author = $article->getAuthor();
        $sendParams = $this->params->get('app.mailer');
        $email = (new TemplatedEmail())
            ->from(new Address($sendParams['from_email'], $sendParams['title']))
            ->to(new Address($author->getEmail(), $author->getFirstName()))
            ->htmlTemplate('email/newArticle.html.twig')
            ->subject('Создана новая статья')
            ->context([
                'article' => $article,
            ]);

        $this->mailer->send($email);
    }

    public function sendWeeklyNewsletter(User $user, array $articles)
    {
        $this->send(
            'email/weekly-newsletter.html.twig',
            'Еженедельная рассылка статей',
            $user,
            function (TemplatedEmail $email) use ($articles) {
                $email
                    ->context([
                        'articles' => $articles,
                    ])
                    ->attach('Опубликовано статей на сайте: ' . count($articles), 'report_' . date('Y-m-d') . '.txt');
            }
        );
    }

    public function sendStatisticReport(User $user, string $statistic)
    {
        $this->send(
            'email/statistic.html.twig',
            'Отчет администратору',
            $user,
            function (TemplatedEmail $email) use ($statistic) {
                $email
                    ->attach($statistic, 'statistic.csv', 'text/csv');
            }
        );
    }

    private function send(string $template, string $subject, User $user, Closure $callback = null)
    {
        $sendParams = $this->params->get('app.mailer');
        $email = (new TemplatedEmail())
            ->from(new Address($sendParams['from_email'], $sendParams['title']))
            ->to(new Address($user->getEmail(), $user->getFirstName()))
            ->htmlTemplate($template)
            ->subject($subject);

        if ($callback) {
            $callback($email);
        }

        $this->mailer->send($email);
    }
}
