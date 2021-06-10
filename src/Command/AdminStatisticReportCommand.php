<?php

namespace App\Command;

use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Service\Mailer;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class AdminStatisticReportCommand extends Command
{
    protected static $defaultName = 'app:admin-statistic-report';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    public function __construct(UserRepository $userRepository, ArticleRepository $articleRepository, Mailer $mailer, ContainerBagInterface $params)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
        $this->mailer = $mailer;
        $this->params = $params;
    }

    protected function configure()
    {
        $this
            ->setDescription('Отчет администратору')
            ->addArgument('email', InputArgument::REQUIRED, 'email получателя')
            ->addOption('dateFrom', null, InputOption::VALUE_OPTIONAL, 'Дата начала периода', '-1 week')
            ->addOption('dateTo', null, InputOption::VALUE_OPTIONAL, 'Дата окончания периода');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = $this->userRepository->findOneBy(['email' => $input->getArgument('email')]);

        if (!$user) {
            $io->warning('Пользователь не найден');
            return Command::FAILURE;
        }

        $dateFrom = new DateTime($input->getOption('dateFrom'));
        $dateTo = new DateTime($input->getOption('dateTo'));
        $statistic = [
            'Период' => sprintf('%s - %s', $dateFrom->format('d.m.Y'), $dateTo->format('d.m.Y')),
            'Всего пользователей' => $this->userRepository->getCount(),
            'Статей создано за период' => $this->articleRepository->findCreatedCountForThePeriod($dateFrom, $dateTo),
            'Статей опубликовано за период' => $this->articleRepository->findPublishedCountForThePeriod($dateFrom, $dateTo),
        ];

        $this->saveToCsvFile($statistic);

        $this->mailer->sendStatisticReport($user);

        return Command::SUCCESS;
    }

    private function saveToCsvFile(array $data): void
    {
        $fp = fopen($this->params->get('reports_url') . '/statistic.csv', 'w');
        fputcsv($fp, array_keys($data));
        fputcsv($fp, array_values($data));
        fclose($fp);
    }
}
