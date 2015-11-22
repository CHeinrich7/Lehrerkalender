<?php

namespace MarkBundle\Controller;

use EducationCalendarBundle\Entity\TeachingUnit;
use MarkBundle\Entity\MarkEntity;
use SubjectBundle\Entity\StudentEntity;
use SubjectBundle\Entity\SubjectEntity as Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MarkController extends Controller
{
    public function indexAction(Subject $subject)
    {
        $data = [];
        $students       = $subject->getEducationClass()->getStudents();
        $teachingUnits  = $subject->getTeachingUnits();

        foreach($students as $student) /** @var StudentEntity $student */
        {
            $studentData = [
                'id'    => $student->getId(),
                'firstname' => $student->getFirstname(),
                'lastname'  => $student->getLastname(),
                'teachingUnits' => []
            ];

            $marks = $student->getMarks();

            foreach($teachingUnits as $teachingUnit) { /** @var $teachingUnit TeachingUnit */
                $studentData['teachingUnits'][$teachingUnit->getId()] = null;
            }

            foreach($marks as $mark) { /** @var MarkEntity $mark */
                $markSubject = $mark->getTeachingUnit()->getSubject();

                if($markSubject->getId() === $subject->getId()) {
                    $studentData['teachingUnits'][$mark->getTeachingUnit()->getId()] = $mark->getMark();
                }
            }

            $data[] = $studentData;
        }

        return $this->render('MarkBundle:mark:index.html.php', [
            'data'          => $data,
            'teachingUnits' => $teachingUnits,
            'subject'       => $subject
        ]);
    }

    function loadAction($student, $teachingUnit)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $mark = $em->getRepository('MarkBundle:MarkEntity')->findOneBy([
            'student'       => $student,
            'teachingUnit'  => $teachingUnit
        ]);

        $new = false;

        if($mark instanceof MarkEntity !== true) {
            $mark = new MarkEntity();
            $new = true;
        }

        return new JsonResponse([
            'mark'  => $mark->getMark(),
            'type'  => $mark->getType(),
            'new'   => $new
        ]);
    }

    function saveAction(Request $request, StudentEntity $student, TeachingUnit $teachingUnit)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $markEntity = $em->getRepository('MarkBundle:MarkEntity')->findOneBy([
            'student'       => $student,
            'teachingUnit'  => $teachingUnit
        ]);

        $new = false;

        if($markEntity instanceof MarkEntity !== true) {
            $markEntity = new MarkEntity();
            $new = true;

            $markEntity
                ->setStudent($student)
                ->setTeachingUnit($teachingUnit);
        }

        $type = $request->get('type');
        $mark = $request->get('mark');

        $markEntity
            ->setType($type)
            ->setMark($mark);

        $em->persist($markEntity);
        $em->flush();

        return new JsonResponse([
            'mark'  => $markEntity->getMark(),
            'type'  => $markEntity->getType(),
            'new'   => $new
        ]);
    }
}
