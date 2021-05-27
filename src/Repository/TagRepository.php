<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    use QueryHelper;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function findAllWithSearchQuery(?string $search, bool $showDeleted = false): QueryBuilder
    {
        $qb = $this->createQueryBuilder('t');
        $qFields = ["t.name", "t.slug", "a.title"];
        $this->withSearchQuery($qb, $qFields, $search);
        $this->withShowDeletedQuery($this, $showDeleted);

        return $qb
            ->innerJoin('t.articles', 'a')
            ->addSelect('a')
            ->orderBy('t.createdAt', 'DESC');
    }
}
