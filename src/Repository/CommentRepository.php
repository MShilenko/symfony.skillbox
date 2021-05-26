<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    use QueryHelper;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findAllWithSearch(?string $search, bool $showDeleted = false): array
    {
        $qb = $this->createQueryBuilder('c');
        $this->withSearchQuery($qb, $search);
        $this->withShowDeletedQuery($qb, $showDeleted);

        return $qb
            ->innerJoin('c.article', 'a')
            ->addSelect('a')
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    private function withSearchQuery(QueryBuilder $qb, ?string $search): QueryBuilder
    {
        if ($search) {
            $qb
                ->andWhere(
                    'c.content LIKE :search 
                    OR c.authorName LIKE :search
                    OR a.title LIKE :search'
                )
                ->setParameter('search', "%{$search}%");
        }

        return $qb;
    }

    private function withShowDeletedQuery(QueryBuilder $qb, bool $showDeleted): QueryBuilder
    {
        if (!$showDeleted) {
            $qb->andWhere('c.deletedAt IS NULL');
        }

        return $qb;
    }

    public function findLatestWithLimit(int $limit): array
    {
        return $this
            ->published($this->latest())
            ->innerJoin("{$this->_class->getTableName()}.article", "a")
            ->addSelect('a')
            ->orderBy("{$this->_class->getTableName()}.createdAt", "DESC")
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
