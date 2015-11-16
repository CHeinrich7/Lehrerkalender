<?php

namespace ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ExampleBundle:Default:index.html.php', array('name' => $name));
    }

    public function calendarAction() {
        return $this->render('ExampleBundle:Default:calendar.html.php');
    }
}





