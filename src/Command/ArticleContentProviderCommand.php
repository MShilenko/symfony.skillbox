<?php

namespace App\Command;

use App\Homework\ArticleContentProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleContentProviderCommand extends Command
{
    protected static $defaultName = 'app:article:content_provider';
    /** @var ArticleContentProviderInterface $articleContentProvider */
    private $articleContentProvider;

    public function __construct(ArticleContentProviderInterface $articleContentProvider) 
    {
        parent::__construct();
        $this->articleContentProvider = $articleContentProvider;
    }

    protected function configure()
    {
        $this
            ->setDescription('Генерация "случайного" текста статьи')
            ->addArgument('paragraphs', InputArgument::REQUIRED, 'Количество параграфов')
            ->addArgument('word', InputArgument::OPTIONAL, 'Ключевое слово')
            ->addArgument('wordsCount', InputArgument::OPTIONAL, 'Количество повторений ключевого слова', 0)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $paragraphs = (int) $input->getArgument('paragraphs');
        $word = $input->getArgument('word');
        $wordsCount = (int) $input->getArgument('wordsCount');

        if ($paragraphs <= 0) {
            $io->error(sprintf('Первый аргумент должен быть положительным числом'));

            return Command::FAILURE;
        }

        if ($word && !is_string($word)) {
            $io->error(sprintf('Второй аргумент должен быть строкой'));

            return Command::FAILURE;
        }

        if (isset($wordsCount) && $wordsCount <= 0) {
            $io->error(sprintf('Третий аргумент должен быть числом'));

            return Command::FAILURE;
        }

        $io->text($this->articleContentProvider->get($paragraphs, $word, $wordsCount));

        return Command::SUCCESS;
    }
}
