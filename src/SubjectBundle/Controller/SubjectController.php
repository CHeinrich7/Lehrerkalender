<?php

namespace SubjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubjectController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SubjectBundle:Subject:index.html.php', array('name' => $name));
    }
}
