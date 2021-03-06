<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\BlogArticle;

/**
 * BlogArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogArticleRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @param EntityInterface $entity
     */
    public function add(EntityInterface $entity)
    {
        assert($entity instanceof BlogArticle);
        $this->getEntityManager()->persist($entity);
        $this->flush();
    }

    /**
     * @param  string $year
     * @param  string $month
     * @return array
     */
    public function findByYearAndMonth($year, $month)
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('b')
            ->from('AppBundle\Entity\BlogArticle', 'b')
            ->leftJoin('AppBundle\Entity\Category', 'ca', \Doctrine\ORM\Query\Expr\Join::WITH, 'b.category = ca.id')
            ->leftJoin('AppBundle\Entity\Comment', 'co', \Doctrine\ORM\Query\Expr\Join::WITH, 'b.id = co.blog')
            ->where('YEAR(b.created_at) = :year')
            ->andWhere('MONTH(b.created_at) = :month')
            ->setParameter(':year', $year)
            ->setParameter(':month', $month)
            ->orderBy('b.created_at', 'DESC');

        $posts = $qb->getQuery()->getResult();

        return $posts;
    }

    /**
     * @param  EntityInterface $entity
     */
    public function remove(EntityInterface $entity)
    {
        assert($entity instanceof BlogArticle);
        $this->getEntityManager()->remove($entity);
        $this->flush();
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
