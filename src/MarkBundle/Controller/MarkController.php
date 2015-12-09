<?php

namespace MarkBundle\Controller;

use EducationCalendarBundle\Entity\TeachingUnit;
use MarkBundle\Entity\MarkEntity;
use MarkBundle\Entity\Repository\MarkRepository;
use SubjectBundle\Entity\StudentEntity;
use SubjectBundle\Entity\SubjectEntity as Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MarkController extends Controller
{
    const INDEX_TEMPLATE = 'MarkBundle:mark:index.html.php';

    /**
     * @param Subject $subject
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

        return $this->render(self::INDEX_TEMPLATE, [
            'data'          => $data,
            'teachingUnits' => $teachingUnits,
            'subject'       => $subject
        ]);
    }

    /**
     * @param StudentEntity $student
     * @param TeachingUnit  $teachingUnit
     *
     * @return JsonResponse
     */
    function loadAction(StudentEntity $student, TeachingUnit $teachingUnit)
    {
        $mark = $this->getRepository()->findOneBy([
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
        $markEntity = $this->getRepository()->updateEntityByRequest($request, $student, $teachingUnit);

        return new JsonResponse([
            'mark'  => $markEntity->getMark(),
            'type'  => $markEntity->getType()
        ]);
    }

    /**
     * @return MarkRepository
     */
    private function getRepository()
    {
        return $this->get('mark_repository');
    }
}
