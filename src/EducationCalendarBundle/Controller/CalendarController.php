<?php

namespace EducationCalendarBundle\Controller;

use EducationCalendarBundle\Entity\Repository\TeachingUnitRepository;
use EducationCalendarBundle\Entity\TeachingUnitEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CalendarController
 * @package EducationCalendarBundle\Controller
 */
class CalendarController extends Controller
{
    public function calendarAction()
    {
        /** @var Response */
        $response = $this->forward('EducationCalendarBundle:Calendar:getAccordionResponse', ['time' => time()]);

        return $this->render(
            'EducationCalendarBundle:Calendar:calendar.html.php',
            array(
                'tableResponse'     => $response,
                'education_classes' => $this->get('education_class_repository')->findUserClasses($this->getUser())
            )
        );
    }

    /**
     * @param integer $time date
     *
     * @return Response
     */
    public function getAccordionResponseAction($time)
    {
        $subjects = $this->get('subject_repository')->findUserSubjects($this->getUser());

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
                        'subjects'  => $subjects,
                        'time'      => $time
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
        $teachingUnits = $this->getRepository()
            ->findByUserAndWeek(
                $this->getUser(),
                $time
            );

        $data = $this->getPreparedDayData($time);
        foreach($teachingUnits as $teachingUnit) /** @var TeachingUnitEntity $teachingUnit */
        {
            $day    = $teachingUnit->getDate()->format('w')-1;
            $block  = $teachingUnit->getUnitBlock();
            $data[$day]['blocks'][$block] = $teachingUnit;
        }

        ksort($data);
        return $data;
    }

    /**
     * @param $time
     *
     * @return array
     */
    private function getPreparedDayData($time)
    {
        // this is an example how a multilanguage system could look like
        $daysOfWeek = [
            'en' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'de' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']
        ];

        $tomorrow   = strtotime('tomorrow', $time);
        $monday     = strtotime('last monday', $tomorrow);

        // 5 blocks per day
        $blocks = [ 1 => null, 2 => null, 3 => null, 4 => null, 5 => null ];


        // prepare data array
        $data = [];
        foreach($daysOfWeek['en'] as $key => $dayString)
        {
            $lowerDayString = strtolower($dayString);

            $dayTime = ($lowerDayString == 'monday') ? $monday : strtotime('next ' . $lowerDayString, $monday);

            $data[] = [
                'day'       => $daysOfWeek['de'][$key],
                'time'      => $dayTime,
                'blocks'    => $blocks
            ];
        }

        return $data;
    }

    /**
     * @return TeachingUnitRepository
     */
    private function getRepository()
    {
        return $this->get('teaching_unit_repository');
    }
}
