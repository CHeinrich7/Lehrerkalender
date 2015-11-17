<?php

namespace EducationCalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    public function selectAction()
    {
        return $this->render('EducationCalendarBundle:Calendar:selectclass.html.php');
    }
    public function calendarAction()
    {
        return $this->render('EducationCalendarBundle:Calendar:calendar.html.php');
    }
}
