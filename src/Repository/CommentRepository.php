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

    public function findAllWithSearchQuery(?string $search, bool $showDeleted = false): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');
        $qFields = ["c.content", "c.authorName", "a.title"];
        $this->withSearchQuery($qb, $qFields, $search);
        $this->withShowDeletedQuery($this, $showDeleted);

        return $qb
            ->innerJoin('c.article', 'a')
            ->addSelect('a')
            ->orderBy('c.createdAt', 'DESC');
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
