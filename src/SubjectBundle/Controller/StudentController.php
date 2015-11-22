<?php
/**
 * User: cheinrich
 * Date: 22.11.2015
 * Time: 13:32
 */

namespace SubjectBundle\Controller;


use SubjectBundle\Entity\StudentEntity;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    /**
     * @param Request       $request
     * @param SubjectEntity $subject
     * @param string        $studentId
     */
    public function saveAction(Request $request, SubjectEntity $subject, $studentId)
    {
        $firstname = $request->get('firstname');
        $lastname  = $request->get('lastname');

        $em = $this->get('doctrine.orm.default_entity_manager');

        if(is_numeric($studentId)) {
            $new = false;
            $student = $em->getRepository('SubjectBundle:StudentEntity')->find($studentId);
        } else {
            $new = true;
            $student = new StudentEntity();
        }

        $student
            ->setFirstname($firstname)
            ->setLastname($lastname);

        $em->persist($student);
        $em->flush();

        return new JsonResponse([
            'id'        => $student->getId(),
            'firstname' => $student->getFirstname(),
            'lastname'  => $student->getLastname(),
            'new'       => $new
        ]);
    }
}