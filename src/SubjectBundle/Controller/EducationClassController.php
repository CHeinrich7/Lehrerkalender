<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\Repository\EducationClassRepository;
use SubjectBundle\Entity\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EducationClassController
 * @package SubjectBundle\Controller
 */
class EducationClassController extends Controller
{
    const INDEX_TEMPLATE  = 'SubjectBundle:EducationClass:index.html.php';
    const SELECT_TEMPLATE = 'SubjectBundle:EducationClass:select.html.php';

    /**
     * @return Response
     */
    public function selectAction()
    {
        /** @var $subjectRepository SubjectRepository */
        $subjectRepository        = $this->get('subject_repository');
        $educationClassRepository = $this->getRepository();

        $userSubjects       = $subjectRepository->findAllAsArray($this->getUser());
        $allSubjects        = $subjectRepository->findAllDistinct();
        $educationClasses   = $educationClassRepository->findAllAsArray();

        return $this->render(self::SELECT_TEMPLATE, array(
            'userSubjects'      => $userSubjects,
            'educationClasses'  => $educationClasses,
            'allSubjects'       => $allSubjects
        ));
    }

    public function indexAction()
    {
        return $this->render(
            self::INDEX_TEMPLATE, [
                'educationClasses' => $this->getRepository()->findAllOrdered()
            ]);
    }

    /**
     * @return EducationClassRepository
     */
    private function getRepository()
    {
        return $this->get('education_class_repository');
    }
}