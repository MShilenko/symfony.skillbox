<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;

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
}
