<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixtures extends Fixture
{
    /** @var Factory $faker */
    protected $faker;

    /** @var ObjectManager $faker */
    protected $manager;

    abstract function loadData(ObjectManager $manager);

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->manager = $manager;

        $this->loadData($manager);
    }

    /**
     * Запуск одной фикстуры
     *
     * @param string $className
     * @param callable $factory
     * @return $entity
     */
    protected function create(string $className, callable $factory)
    {
        $entity = new $className();
        $factory($entity);

        $this->manager->persist($entity);

        return $entity;
    }

    /**
     * Метод для множественного запуска фикстур. Позволяет в callable описать заполнение конкретных полей.
     *
     * @param string $className
     * @param integer $count
     * @param callable $factory
     * @return void
     */
    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) { 
           $this->create($className, $factory);
        }

        $this->manager->flush();
    }
}
