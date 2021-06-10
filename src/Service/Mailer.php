<?php

namespace App\Service;

use Closure;
use App\Entity\User;
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

    public function sendStatisticReport(User $user)
    {
        $this->send(
            'email/statistic.html.twig',
            'Отчет администратору',
            $user,
            function (TemplatedEmail $email) {
                $email
                    ->attachFromPath($this->params->get('reports_url') . '/statistic.csv');
            }
        );
    }

    private function send(string $template, string $subject, User $user, Closure $callback = null)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@symfony.skillbox', 'Spill-Coffee-On-The-Keyboard'))
            ->to(new Address($user->getEmail(), $user->getFirstName()))
            ->htmlTemplate($template)
            ->subject($subject);

        if ($callback) {
            $callback($email);
        }

        $this->mailer->send($email);
    }
}
