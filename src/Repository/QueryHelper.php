<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

trait QueryHelper
{
    /**
     * Создаем или получаем имеющийся построитель запросов
     *
     * @param QueryBuilder|null $queryBuilder
     * @return QueryBuilder
     */
    public function getOrCreateQueryBuilder(?QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder($this->_class->getTableName());
    }

    /**
     * Только опубликованные
     *
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    public function published(QueryBuilder $qb = null): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->andWhere("{$this->_class->getTableName()}.deletedAt IS NULL");
    }

    /**
     * Сортируем по дате создания
     *
     * @param QueryBuilder $qb
     * @param string $sort
     * @return QueryBuilder
     */
    public function latest(QueryBuilder $qb = null, string $sort = 'DESC'): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->orderBy("{$this->_class->getTableName()}.createdAt", $sort);
    }

    /**
     * Добавляем поисковый запрос
     *
     * @param QueryBuilder $qb
     * @param array $fields
     * @param string|null $search
     * @return QueryBuilder
     */
    private function withSearchQuery(QueryBuilder $qb, array $fields, ?string $search): QueryBuilder
    {
        $query = '';

        if ($search) {
            foreach ($fields as $k => $f) {
                $query .= $k > 0 ? " OR {$f} LIKE :search" : "{$f} LIKE :search";
            }

            $qb
                ->andWhere($query)
                ->setParameter('search', "%{$search}%");
        }

        return $qb;
    }

    /**
     * Отключаем фильтр не показывающий удаленные записи в списке
     *
     * @param ServiceEntityRepository $repository
     * @param boolean $showDeleted
     * @return void
     */
    private function withShowDeletedQuery(ServiceEntityRepository $repository, bool $showDeleted): void
    {
        if ($showDeleted) {
            $repository->getEntityManager()->getFilters()->disable('softdeleteable');
        }
    }
}
