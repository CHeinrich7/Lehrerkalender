<?php
/**
 * User: cheinrich
 * Date: 22.11.2015
 * Time: 13:32
 */

namespace SubjectBundle\Controller;


use SubjectBundle\Entity\Repository\StudentRepository;
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
     *
     * @return JsonResponse
     */
    public function newAction(Request $request, SubjectEntity $subject)
    {
        $student = $this->getRepository()->createStudent($request, $subject->getEducationClass());

        return new JsonResponse([
            'id'        => $student->getId(),
            'firstname' => $student->getFirstname(),
            'lastname'  => $student->getLastname()
        ]);
    }

    /**
     * @param Request       $request
     * @param StudentEntity $student
     *
     * @return JsonResponse
     */
    public function saveAction(Request $request, StudentEntity $student)
    {
        $this->getRepository()->updatEntityByRequest($request, $student);

        return new JsonResponse([
            'id'        => $student->getId(),
            'firstname' => $student->getFirstname(),
            'lastname'  => $student->getLastname()
        ]);
    }

    /**
     * @return StudentRepository
     */
    private function getRepository()
    {
        return $this->get('student_repository');
    }
}