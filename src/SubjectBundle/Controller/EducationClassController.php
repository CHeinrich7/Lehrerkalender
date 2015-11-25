<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EducationClassController extends Controller
{
    public function selectAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        /** @var SubjectEntity $subjectEntities */
        $subjectEntities = $em->getRepository('SubjectBundle:SubjectEntity')->findAllDistinct();
        $classEntities = $em->getRepository('SubjectBundle:EducationClassEntity')->findAll();

        return $this->render('SubjectBundle:EducationClass:selectClass.html.php', array('subjectEntities' => $subjectEntities, 'classEntities' => $classEntities));
    }
}