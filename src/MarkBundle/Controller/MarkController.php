<?php

namespace MarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarkController extends Controller
{
    public function indexAction($subject)
    {
        return $this->render('MarkBundle:mark:index.html.php');
    }
}
