<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    use QueryHelper;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function published(QueryBuilder $qb = null): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->andWhere('article.publishedAt IS NOT NULL');
    }

    public function latest(QueryBuilder $qb = null, string $sort = 'DESC'): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->orderBy("{$this->_class->getTableName()}.publishedAt", $sort);
    }

    public function findLatestPublished(): array
    {
        return $this
            ->published($this->latest())
            ->innerJoin('article.comments', 'comments')
            ->addSelect('comments')
            ->getQuery()
            ->getResult();
    }

    public function getArticleWithComments(string $slug = ''): ?Article
    {
        $qb = $this->createQueryBuilder('article');

        return $qb
            ->where('article.slug = :slug')
            ->setParameter('slug', $slug)
            ->innerJoin('article.comments', 'comments')
            ->addSelect('comments')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
