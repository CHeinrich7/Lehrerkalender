<?php

namespace EducationCalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EducationCalendarBundle:Default:index.html.php', array('name' => $name));
    }

    public function endAction()
    {
        var_dump($this->getUser()->getRoles()[0]);
        return $this->render('EducationCalendarBundle:Default:end.html.php');
    }
}
