<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserDeactivateCommand extends Command
{
    protected static $defaultName = 'app:user:deactivate';

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager) 
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Деактивирует пользователя')
            ->addArgument('id', InputArgument::REQUIRED, 'Id пользователя')
            ->addOption('reverse', null, InputOption::VALUE_OPTIONAL, 'Восстановить пользователя', true);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        if (!$id) {
            throw new \Exception('Укажите Id пользователя');
        }

        if (!$user = $this->userRepository->findOneBy(['id' => $id])) {
            throw new \Exception("Пользователь с Id {$id} не найден!");
        }

        if ($input->getOption('reverse')) {
            $user->setIsActive(false);
        } else {
            $user->setIsActive(true);
        }

        $this->entityManager->flush($user);

        $io->success("Данные пользователя с Id {$id} успешно обновлены!");

        return Command::SUCCESS;
    }
}
