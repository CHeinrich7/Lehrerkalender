<?php

namespace SubjectBundle\Controller;

use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class SubjectController
 * @package SubjectBundle\Controller
 */
class SubjectController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $subject = $request->get('education_subject');
        $edClass = $request->get('education_class');

        $subjectEntity = new SubjectEntity();
        $subjectEntity->setName($subject['key']);

        $edClassEntity = null;

        if(!empty($edClass['val'])) {
            $edClassEntity = $this->get('education_class_repository')->find($edClass['val']);
        }

        if ($edClassEntity instanceof EducationClassEntity !== true) {
            $edClassEntity = new EducationClassEntity();
            $edClassEntity->setName($edClass['key']);
        }

        $subjectEntity->setEducationClass($edClassEntity);

        $status = $this->validateEntites([$subjectEntity, $edClassEntity]);
        if($status === 200) {
            $em = $this->get('doctrine.orm.default_entity_manager');
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
     * @return integer
     *
     * @throws \Exception
     */
    private function validateEntites(array $entities)
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->get('validator');

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
