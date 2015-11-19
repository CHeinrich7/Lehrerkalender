<?php

namespace EducationCalendarBundle\Controller;

use EducationCalendarBundle\Entity\TeachingUnit;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends Controller
{
    public function calendarAction()
    {
        /** @var Response */
        $response = $this->forward('EducationCalendarBundle:Calendar:getTable', ['time' => time()]);

        return $this->render('EducationCalendarBundle:Calendar:calendar.html.php',array('tableResponse' => $response));
    }

    /**
     * @param integer $time date
     *
     * @return Response
     */
    public function getTableAction($time)
    {
        $subjects = $this->getUserSubjects();

        $data = $this->getPreparedTableData($time);

        $response = '';
        foreach($data as $index => $dayData)
        {
            ksort($dayData['blocks']);

            $response .=
                $this
                    ->render('EducationCalendarBundle:Calendar:accordionPanel.html.php', [
                        'data'      => $dayData,
                        'index'     => $index,
                        'subjects'  => $subjects
                    ])
                    ->getContent();
        }

        return new Response($response);
    }

    /**
     * @param integer $time
     * @return array
     */
    private function getPreparedTableData($time)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $teachingUnits = $em
            ->getRepository('EducationCalendarBundle:TeachingUnit')
            ->findByUserAndWeek(
                $this->getUser(),
                $time
            );

        $data = $this->getPreparedDayData();
        foreach($teachingUnits as $teachingUnit)
        {
            $day    = $teachingUnit->getDate()->format('w')-1;
            $block  = $teachingUnit->getUnitBlock()-1;
            $data[$day]['blocks'][$block] = $teachingUnit;
        }

        ksort($data);
        return $data;
    }

    /**
     * @return array
     */
    private function getPreparedDayData()
    {
        // this is an example how a multilanguage system could look like
        $daysOfWeek = [
            'en' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'de' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']
        ];

        // 5 blocks per day
        $blocks = [ 1 => null, 2 => null, 3 => null, 4 => null, 5 => null ];


        // prepare data array
        $data = [];
        foreach($daysOfWeek['en'] as $key => $dayString)
        {
            $data[] = [
                'day'       => $daysOfWeek['de'][$key],
                'blocks'    => $blocks
            ];
        }

        return $data;
    }

    /**
     * @return array
     */
    private function getUserSubjects()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        /** @var $subjectEntities[] $subjects */
        $subjectEntities = $em
            ->getRepository('SubjectBundle:SubjectEntity')
            ->findBy(['createdBy' => $this->getUser()]);

        // prepare subject names by id
        $subjects = [];
        foreach($subjectEntities as $subjectEntity)
        {
            $subjects[$subjectEntity->getId()] = $subjectEntity->getNameWithEducationClassName();
        }

        return $subjects;
    }
}
