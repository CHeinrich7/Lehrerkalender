<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        $status = $this->validateEntites([$subjectEntity, $edClassEntity]);
        if($status === 200) {
            $em->persist($subjectEntity);
            $em->persist($edClassEntity);

            $em->flush();
        }


        return new JsonResponse([
            'data' => [
                'subject' => $subject,
                'edClass' => $edClass,
            ],
            $status
        ]);
    }

    /**
     * @param array $entities
     *
     * @return int
     *
     * @throws \Exception
     */
    private function validateEntites(array $entities)
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->get('validator');

        $status = 200;
        foreach($entities as $entity)
        {
            $errors = $validator->validate($entity);
            if($errors->count() > 0) {
                throw new \Exception('Entity ' . get_class($entity) . ' not Valid!');
            }
        }

        return 200;
    }
}
