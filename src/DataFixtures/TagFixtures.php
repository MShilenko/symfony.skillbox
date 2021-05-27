<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Article;
use App\DataFixtures\BaseFixtures;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Tag::class, $this->faker->numberBetween(50, 100), function (Tag $tag) {
            $tag
                ->setName($this->faker->realText(15))
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));

            if ($this->faker->boolean(70)) {
                $tag->setDeletedAt($this->faker->dateTimeBetween('-10 days', '-1 days'));
            }
        });
    }
}
