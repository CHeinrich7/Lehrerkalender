<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:56
 */

namespace SubjectBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use SubjectBundle\Entity\SubjectEntity;
use UserBundle\Entity\User;

class SubjectRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return SubjectEntity[]
     */
    public function findAllAsArray($user = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb
            ->select('s.name as name', 's.id as id', 'c.name as class')
            ->join('s.educationClass', 'c');

        if($user instanceof User) {
            $qb
                ->where('s.createdBy = :user')
                ->setParameter('user', $user);
        }

        return $qb->getQuery()->getResult();
    }

    public function findAllDistinct()
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb
            ->select('s.name as name')
            ->orderBy('s.name')
            ->distinct(true);

        return $qb->getQuery()->getResult();
    }
}