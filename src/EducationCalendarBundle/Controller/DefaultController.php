<?php

namespace EducationCalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function endAction()
    {
        var_dump($this->getUser()->getRoles()[0]);
        return $this->render('EducationCalendarBundle:Default:end.html.php');
    }

    public function selectAction()
    {
        return $this->render('EducationCalendarBundle:Default:select.html.php');
    }
    public function calendarAction() {
        return $this->render('EducationCalendarBundle:Default:calendar.html.php');
    }
}
