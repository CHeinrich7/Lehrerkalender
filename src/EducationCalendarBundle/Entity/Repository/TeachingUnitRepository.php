<?php
/**
 * User: cheinrich
 * Date: 19.11.2015
 * Time: 15:52
 */

namespace EducationCalendarBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use EducationCalendarBundle\Entity\TeachingUnit;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @param Request       $request
     * @param SubjectEntity $subject
     * @param User          $user
     * @param integer       $block
     * @param integer       $time
     *
     * @return bool
     */
    public function saveByData(Request $request, SubjectEntity $subject, User $user, $block, $time)
    {
        $success = true;

        $date = new \DateTime();
        $date->setTimestamp($time);

        $teachingUnit = $this
            ->findOneBy([
                'unitBlock' => $block,
                'date'      => $date,
                'createdBy' => $user
            ]);

        if($teachingUnit instanceof TeachingUnit !== true)
        {
            $teachingUnit = new TeachingUnit();
            $teachingUnit
                ->setUnitBlock($block)
                ->setDate($date);
        }

        $teachingUnit->setSubject($subject);

        $value = $request->get('val');

        switch($request->get('key')) {
            case 'block':
                $teachingUnit->setUnitBlock($value);
                break;
            case 'room':
                $teachingUnit->setRoom($value);
                break;
            case 'content':
                $teachingUnit->setContent($value);
                break;
            case 'notice':
                $teachingUnit->setNotice($value);
                break;
            case 'default':
                $success = false;
        }

        if($success !== false) {
            $this->_em->persist($teachingUnit);
            $this->_em->flush();
        }

        return $success;
    }

    /**
     * @param User      $user
     * @param integer   $block
     * @param integer   $time
     *
     * @return bool
     */
    public function removeByData(User $user, $block, $time)
    {
        $date = new \DateTime();
        $date->setTimestamp($time);

        $teachingUnit = $this
            ->findOneBy([
                'unitBlock' => $block,
                'date'      => $date,
                'createdBy' => $user
            ]);

        if($teachingUnit instanceof TeachingUnit === true) {
            $this->_em->remove($teachingUnit);
            $this->_em->flush();

            return true;
        }

        return false;
    }
}