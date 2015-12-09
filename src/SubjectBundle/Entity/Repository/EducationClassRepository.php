<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:49
 */

namespace SubjectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use SubjectBundle\Entity\EducationClassEntity;
use UserBundle\Entity\User;


class EducationClassRepository extends EntityRepository
{
    /**
     * @return EducationClassEntity[]
     */
    public function findAllOrdered()
    {
        $qb = $this->createQueryBuilder('c');

        $qb->addOrderBy('c.name');

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array
     */
    public function findAllAsArray()
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c.id as id', 'c.name as name')
            ->orderBy('c.name');

        return $qb->getQuery()->getResult();
    }


    public function findUserClasses(User $user)
    {
        /** @var EducationClassEntity[] $subjects */
        $classEntities = $this->findBy(['createdBy' => $user]);

        // prepare subject names by id
        $subjects = [];
        foreach($classEntities as $classEntity) { /** @var EducationClassEntity $classEntity */
            $subjects[$classEntity->getId()] = ['name'  => $classEntity->getName()];
        }

        return $subjects;
    }
}