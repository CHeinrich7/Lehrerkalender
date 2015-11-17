<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:56
 */

namespace SubjectBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class SubjectRepository extends EntityRepository
{
    public function findAllDistinct()
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb->distinct(true);

        $qb->getQuery()->getResult();
    }
}