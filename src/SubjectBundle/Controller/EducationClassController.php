<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\Repository\SubjectRepository;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Role;

class EducationClassController extends Controller
{
    public function selectAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        /** @var $subjectRepository SubjectRepository */
        $subjectRepository = $em->getRepository('SubjectBundle:SubjectEntity');

        $userSubjects = $subjectRepository->findAllAsArray($this->getUser());
        $classEntities = $em->getRepository('SubjectBundle:EducationClassEntity')->findAll();

        /** @var array $allSubjects */
        $allSubjects = $em->getRepository('SubjectBundle:SubjectEntity')->findAllDistinct();

        return $this->render('SubjectBundle:EducationClass:select.html.php', array(
            'userSubjects'  => $userSubjects,
            'classEntities' => $classEntities,
            'allSubjects'   => $allSubjects
        ));
    }

    public function indexAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $educationClassRepository = $em->getRepository('SubjectBundle:EducationClassEntity');

        /** @var EducationClassEntity[] $educationClasses */
        $educationClasses = $educationClassRepository->findAllOrdered();

        return $this->render('SubjectBundle:EducationClass:index.html.php', ['educationClasses' => $educationClasses]);
    }
}