<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SubjectController extends Controller
{
    public function newAction(Request $request)
    {
        $subject = $request->get('education_subject');
        $edClass = $request->get('education_class');

        $em = $this->get('doctrine.orm.default_entity_manager');

        $subjectEntity = new SubjectEntity();
        $subjectEntity->setName($subject['key']);

        $edClassEntity = null;

        if(!empty($edClass['val'])) {
            $edClassEntity = $em->getRepository('SubjectBundle:EducationClassEntity')->find($edClass['val']);
        }

        if ($edClassEntity instanceof EducationClassEntity !== true) {
            $edClassEntity = new EducationClassEntity();
            $edClassEntity->setName($edClass['key']);
        }

        $subjectEntity->setEducationClass($edClassEntity);

        $em->persist($subjectEntity);
        $em->persist($edClassEntity);

        $em->flush();

        return new JsonResponse([
            'data' => [
                'subject' => $subject,
                'edClass' => $edClass,
                'error'   => '',
            ]
        ]);
    }
}
