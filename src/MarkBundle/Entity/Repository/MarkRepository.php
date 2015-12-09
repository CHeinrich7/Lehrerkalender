<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 14:02
 */

namespace MarkBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use EducationCalendarBundle\Entity\TeachingUnit;
use MarkBundle\Entity\MarkEntity;
use SubjectBundle\Entity\StudentEntity;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MarkRepository
 * @package MarkBundle\Entity\Repository
 */
class MarkRepository extends EntityRepository
{
    /**
     * @param Request       $request
     * @param StudentEntity $student
     * @param TeachingUnit  $teachingUnit
     *
     * @return MarkEntity
     */
    public function updateEntityByRequest(Request $request, StudentEntity $student, TeachingUnit $teachingUnit)
    {
        $markEntity = $this->findOneBy([
            'student'       => $student,
            'teachingUnit'  => $teachingUnit
        ]);

        if($markEntity instanceof MarkEntity !== true) {
            $markEntity = new MarkEntity();

            $markEntity
                ->setStudent($student)
                ->setTeachingUnit($teachingUnit);
        }

        $type = $request->get('type');
        $mark = $request->get('mark');

        $markEntity
            ->setType($type)
            ->setMark($mark);

        $this->_em->persist($markEntity);
        $this->_em->flush();

        return $markEntity;
    }
}