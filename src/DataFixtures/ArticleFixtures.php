<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function (Article $article) {
            $article
                ->setTitle($this->faker->words(2, true))
                ->setSlug($this->faker->slug())
                ->setImage('article-' . rand(1, 3) . '.jpg')
                ->setAuthor($this->faker->firstName())
                ->setLikeCount($this->faker->numberBetween(0, 10))
                ->setBody('Lorem ipsum **[кофе](/)** dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua. Purus viverra accumsan in nisl.' . $this->faker->paragraphs($this->faker->numberBetween(2, 5), true));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
        });
    }
}
