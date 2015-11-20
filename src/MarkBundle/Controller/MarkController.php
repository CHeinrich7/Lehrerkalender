<?php

namespace MarkBundle\Controller;

use EducationCalendarBundle\Entity\TeachingUnit;
use MarkBundle\Entity\MarkEntity;
use SubjectBundle\Entity\StudentEntity;
use SubjectBundle\Entity\SubjectEntity as Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
                $studentData['teachingUnits'][$mark->getTeachingUnit()->getId()] = $mark->getMark();
            }

            $data[] = $studentData;
        }

        return $this->render('MarkBundle:mark:index.html.php', [
            'data'          => $data,
            'teachingUnits' => $teachingUnits,
            'subject'       => $subject
        ]);
    }
}
