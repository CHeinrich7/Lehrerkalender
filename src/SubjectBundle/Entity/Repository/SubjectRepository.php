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
    public function findAllDistinct($user = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb->distinct(true);

        if($user instanceof User) {
            $qb
                ->where('s.createdBy = :user')
                ->setParameter('user', $user);
        }

        return $qb->getQuery()->getResult();
    }
}