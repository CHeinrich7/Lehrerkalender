<?php

namespace ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExampleController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ExampleBundle:Examples:index.html.php', array('name' => $name));
    }

    public function calendarAction()
    {
        return $this->render('ExampleBundle:Examples:calendar.html.php');
    }
}





