<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use App\Homework\CommentContentProviderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends BaseFixtures implements DependentFixtureInterface
{
    /** @var CommentContentProviderInterface $commentContentProvider */
    private $commentContentProvider;

    public function __construct(CommentContentProviderInterface $commentContentProviderInterface)
    {
        $this->commentContentProvider = $commentContentProviderInterface;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, $this->faker->numberBetween(50, 100), function (Comment $comment) {
            $comment
                ->setAuthorName($this->faker->firstName())
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
                ->setArticle($this->getRandomReference(Article::class));

            if ($this->faker->boolean(70)) {
                $word = $this->faker->word();
                $wordsCount = $this->faker->numberBetween(1, 5);
            }

            $comment->setContent($this->commentContentProvider->get($word ?? '', $wordsCount ?? 0));

            if ($this->faker->boolean(70)) {
                $comment->setDeletedAt($this->faker->dateTimeBetween('-10 days', '-1 days'));
            }
        });
    }

    public function getDependencies()
    {
        return [ArticleFixtures::class];
    }
}
