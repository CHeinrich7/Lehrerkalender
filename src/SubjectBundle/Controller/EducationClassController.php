<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\Repository\SubjectRepository;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Role;

/**
 * Class EducationClassController
 * @package SubjectBundle\Controller
 */
class EducationClassController extends Controller
{
    const INDEX_TEMPLATE  = 'SubjectBundle:EducationClass:index.html.php';
    const SELECT_TEMPLATE = 'SubjectBundle:EducationClass:select.html.php';

    public function selectAction()
    {
        /** @var $subjectRepository SubjectRepository */
        $subjectRepository = $this->get('subject_repository');

        $userSubjects = $subjectRepository->findAllAsArray($this->getUser());
        $classEntities = $this->get('education_class_repository')->findAll();

        /** @var array $allSubjects */
        $allSubjects = $subjectRepository->findAllDistinct();

        return $this->render(self::SELECT_TEMPLATE, array(
            'userSubjects'  => $userSubjects,
            'classEntities' => $classEntities,
            'allSubjects'   => $allSubjects
        ));
    }

    public function indexAction()
    {
        return $this->render(
            self::INDEX_TEMPLATE, [
                'educationClasses' => $this->get('education_class_repository')->findAllOrdered()
            ]);
    }
}