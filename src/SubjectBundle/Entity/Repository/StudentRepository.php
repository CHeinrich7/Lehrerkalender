<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:56
 */

namespace SubjectBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use SubjectBundle\Entity\EducationClassEntity;
use SubjectBundle\Entity\StudentEntity;
use Symfony\Component\HttpFoundation\Request;

class StudentRepository extends EntityRepository
{
    /**
     * @param Request              $request
     * @param EducationClassEntity $educationClass
     *
     * @return StudentEntity
     */
    public function createStudent(Request $request, EducationClassEntity $educationClass)
    {
        $student = new StudentEntity();

        $student->setEducationClass( $educationClass );

        $this->updatEntityByRequest($request, $student);

        return $student;
    }

    /**
     * @param Request       $request
     * @param StudentEntity $student
     *
     * @return $this|StudentRepository
     */
    public function updatEntityByRequest(Request $request, StudentEntity $student)
    {
        $firstname = $request->get('firstname');
        $lastname  = $request->get('lastname');

        $student
            ->setFirstname($firstname)
            ->setLastname($lastname);

        return $this->persistAndFlush($student);
    }

    /**
     * @param StudentEntity $student
     *
     * @return $this
     */
    private function persistAndFlush(StudentEntity $student)
    {
        $this->_em->persist($student);
        $this->_em->flush($student);

        return $this;
    }
}