<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Article;
use App\Service\FileUploader;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use App\Homework\ArticleContentProviderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends BaseFixtures implements DependentFixtureInterface
{
    /** @var ArticleContentProviderInterface $articleContentProvider */
    private $articleContentProvider;

    /** @var FileUploader $articleFileUploader */
    private $articleFileUploader;

    private static $articleImages = [
        'article-1.jpg',
        'article-2.jpg',
        'article-3.jpg',
    ];


    public function __construct(ArticleContentProviderInterface $articleContentProviderInterface, FileUploader $articleFileUploader)
    {
        $this->articleContentProvider = $articleContentProviderInterface;
        $this->articleFileUploader = $articleFileUploader;
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 25, function (Article $article) {
            $fileName = $this->faker->randomElement(self::$articleImages);

            $article
                ->setTitle($this->faker->words(2, true))
                ->setImage($this->articleFileUploader->uploadFile(new File(dirname(dirname(__DIR__)) . '/public/images/' . $fileName)))
                ->setAuthor($this->getRandomReference(User::class))
                ->setVoteCount($this->faker->numberBetween(0, 10))
                ->setDescription($this->faker->words($this->faker->numberBetween(3, 8), true));

            if ($this->faker->boolean(70)) {
                $word = $this->faker->word();
                $wordsCount = $this->faker->numberBetween(5, 10);
            }

            $article->setBody($this->articleContentProvider->get($this->faker->numberBetween(2, 10), $word ?? '', $wordsCount ?? 0));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }

            if ($this->faker->boolean(50)) {
                $article->setKeywords($this->faker->words($this->faker->numberBetween(2, 6), true));
            }

            for ($i = 0; $i <= rand(0, 4); $i++) {
                $article->addTag($this->getRandomReference(Tag::class));
            }
        });
    }

    public function getDependencies()
    {
        return [
            TagFixtures::class,
            UserFixtures::class
        ];
    }
}
