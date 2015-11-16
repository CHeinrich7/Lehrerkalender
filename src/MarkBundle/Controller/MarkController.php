<?php

namespace MarkBundle\Controller;

use SubjectBundle\Entity\SubjectEntity as Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarkController extends Controller
{
    public function indexAction(Subject $subject)
    {
        return $this->render('MarkBundle:mark:index.html.php');
    }
}
