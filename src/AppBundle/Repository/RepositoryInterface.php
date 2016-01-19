<?php
namespace AppBundle\Repository;

use AppBundle\Entity\EntityInterface;

interface RepositoryInterface
{
    public function add(EntityInterface $entity);
    public function remove(EntityInterface $entity);
}
