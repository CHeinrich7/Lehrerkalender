<?php
/**
 * User: cheinrich
 * Date: 19.11.2015
 * Time: 15:52
 */

namespace EducationCalendarBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use EducationCalendarBundle\Entity\TeachingUnit;
use UserBundle\Entity\User;

class TeachingUnitRepository extends EntityRepository
{
    /**
     * @param User      $user
     * @param integer   $time
     *
     * @return TeachingUnit[]
     */
    public function findByUserAndWeek(User $user, $time)
    {
        // if $time is a 'monday', last monday is not monday of THIS week,
        // so get tomorrow of $time and 'last monday' of tomorrow!
        //
        // ... same reversed with yesterday and 'next sunday'
        $tomorrow  = strtotime('tomorrow', $time);
        $yesterday = strtotime('yesterday', $time);

        $firstDayOfWeek = date('d.m.Y 00:00:00', strtotime('last monday', $tomorrow));
        $lastDayOfWeek  = date('d.m.Y 23:59:59', strtotime('next sunday', $yesterday));

        // typeof TeachingUnit::date === \DateTime
        $firstDate = new \DateTime($firstDayOfWeek);
        $lastDate  = new \DateTime($lastDayOfWeek);

        // SELECT ...
        // FROM teaching_unit t, s
        // JOIN t.subject s
        $qb = $this->createQueryBuilder('t');

        $qb
            ->join('t.subject', 's')

            // only get TeachingUnit by current User (who is owner and created this TeachingUnit)
            ->where('s.createdBy = :user')
            ->andWhere('t.date BETWEEN :firstDate AND :lastDate')

            ->setParameters([
                'user' => $user,
                'firstDate' => $firstDate,
                'lastDate'  => $lastDate
            ])

            // first order by date -> monday, tuesday, ...
            ->orderBy('t.date')
            // then order by unitBlock -> 1, 2, ...
            ->addOrderBy('t.unitBlock')
        ;

        return $qb->getQuery()->getResult();
    }
}