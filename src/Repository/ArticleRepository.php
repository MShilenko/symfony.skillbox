<?php

namespace App\Repository;

use DateTime;
use App\Entity\Article;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
            ->leftJoin('article.comments', 'comments')
            ->addSelect('comments')
            ->leftJoin('article.tags', 'tags')
            ->addSelect('tags')
            ->innerJoin('article.author', 'author')
            ->addSelect('author')
            ->getQuery()
            ->getResult();
    }

    public function findAllPublishedLastWeek()
    {
        return $this->published($this->latest())
            ->andWhere('article.publishedAt >= :week_ago')
            ->setParameter('week_ago', new DateTime('-1 week'))
            ->getQuery()
            ->getResult();
    }

    public function findCreatedCountForThePeriod(DateTime $from, DateTime $to)
    {
        return $this->createQueryBuilder('article')
            ->select('count(article.id)')
            ->andWhere('article.createdAt >= :from')
            ->setParameter('from', $from)
            ->andWhere('article.createdAt <= :to')
            ->setParameter('to', $to)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findPublishedCountForThePeriod(DateTime $from, DateTime $to)
    {
        return $this->createQueryBuilder('article')
            ->select('count(article.id)')
            ->andWhere('article.publishedAt >= :from')
            ->setParameter('from', $from)
            ->andWhere('article.publishedAt <= :to')
            ->setParameter('to', $to)
            ->getQuery()
            ->getSingleScalarResult();
    }


    public function getArticleWithCommentsAndUser(string $slug = ''): ?Article
    {
        $qb = $this->createQueryBuilder('article');

        return $qb
            ->where('article.slug = :slug')
            ->setParameter('slug', $slug)
            ->leftJoin('article.comments', 'comments')
            ->addSelect('comments')
            ->leftJoin('article.tags', 'tags')
            ->addSelect('tags')
            ->innerJoin('article.author', 'author')
            ->addSelect('author')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllWithSearchQuery(?string $search): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a');
        $qFields = ["a.title", "a.body", "author.firstName"];
        $this->withSearchQuery($qb, $qFields, $search);

        return $qb
            ->innerJoin('a.author', 'author')
            ->addSelect('author')
            ->orderBy('a.createdAt', 'DESC');
    }

    // Пример выборки с параметрами для связанной таблицы
    // /**
    //  * @return Collection|Comment[]
    //  */
    // public function getPublishedComments(): Collection
    // {
    //     $criteria = Criteria::create()
    //         ->andWhere(Criteria::expr()->isNull('deletedAt'))
    //         ->orderBy(['createdAt' => "DESC"]);

    //     return $this->comments->matching($criteria);
    // }
}
