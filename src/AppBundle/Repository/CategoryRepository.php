<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\Category;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @param  EntityInterface $entity
     */
    public function add(EntityInterface $entity)
    {
        assert($entity instanceof Category);
        $this->getEntityManager()->persist($entity);
        $this->flush();
    }

    /**
     * @param  EntityInterface $entity
     */
    public function remove(EntityInterface $entity)
    {
        assert($entity instanceof $entity);
        $this->getEntityManager()->remove($entity);
        $this->flush();
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
