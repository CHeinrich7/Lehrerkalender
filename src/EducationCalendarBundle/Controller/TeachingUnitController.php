<?php
/**
 * User: cheinrich
 * Date: 22.11.2015
 * Time: 15:55
 */

namespace EducationCalendarBundle\Controller;


use EducationCalendarBundle\Entity\Repository\TeachingUnitRepository;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TeachingUnitController extends Controller
{
    /**
     * @param Request $request
     * @param integer $block
     * @param integer $time
     *
     * @return JsonResponse
     */
    public function saveTeachingUnitAction(Request $request, SubjectEntity $subject, $block, $time)
    {
        $repo = $this->getRepository();

        $success = $repo->saveByData(
            $request,           // Request
            $subject,           // Subject
            $this->getUser(),   // User
            $block,             // TeachingUnit::unitBlock
            $time               // TeachingUnit::date->getTimestamp
        );

        return new JsonResponse(['success' => $success]);
    }

    /**
     * @param integer $block
     * @param integer $time
     *
     * @return JsonResponse
     */
    public function removeTeachingUnitAction($block, $time)
    {
        $repo = $this->getRepository();

        $removed = $repo->removeByData(
            $this->getUser(),   // User
            $block,             // TeachingUnit::unitBlock
            $time               // TeachingUnit::date->getTimestamp
        );

        return new JsonResponse(['success' => true, 'data' => ['removed' => $removed]]);
    }

    /**
     * @return TeachingUnitRepository
     */
    private function getRepository()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        return $em->getRepository('EducationCalendarBundle:TeachingUnit');
    }
}