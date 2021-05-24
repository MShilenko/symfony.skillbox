<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use App\Homework\ArticleContentProviderInterface;
use App\Homework\CommentContentProviderInterface;

class ArticleFixtures extends BaseFixtures
{
    /** @var ArticleContentProviderInterface $articleContentProvider */
    private $articleContentProvider;

    /** @var CommentContentProviderInterface $commentContentProvider */
    private $commentContentProvider;

    public function __construct(ArticleContentProviderInterface $ap, CommentContentProviderInterface $cp)
    {
        $this->articleContentProvider = $ap;
        $this->commentContentProvider = $cp;
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 10, function (Article $article) {
            $article
                ->setTitle($this->faker->words(2, true))
                ->setImage('article-' . $this->faker->numberBetween(1, 3) . '.jpg')
                ->setAuthor($this->faker->firstName())
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

            $this->addComments($article);
        });
    }

    public function addComments(Article $article): void
    {
        $this->createMany(Comment::class, $this->faker->numberBetween(2, 10), function (Comment $comment) use ($article) {
            $comment
                ->setAuthorName($this->faker->firstName())
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
                ->setArticle($article);

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
}
