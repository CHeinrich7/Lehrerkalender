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
     *
     * @return array
     */
    public function findAllAsArray($user = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb
            ->select('s.name as name', 's.id as id', 'c.name as class')
            ->join('s.educationClass', 'c')
            ->orderBy('s.name');

        if($user instanceof User) {
            $qb
                ->where('s.createdBy = :user')
                ->setParameter('user', $user);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array
     */
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

    public function findUserSubjects(User $user)
    {
        /** @var SubjectEntity[] $subjects */
        $subjectEntities = $this->findBy(['createdBy' => $user]);

        // prepare subject names by id
        $subjects = [];
        foreach($subjectEntities as $subjectEntity) /** @var SubjectEntity $subjectEntity */
        {
            $subjects[$subjectEntity->getId()] = [
                'name'  => $subjectEntity->getNameWithEducationClassName(),
                'class' => $subjectEntity->getEducationClass()->getId()
            ];
        }

        return $subjects;
    }
}