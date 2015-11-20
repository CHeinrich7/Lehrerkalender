<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 14:01
 */

namespace MarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EducationCalendarBundle\Entity\TeachingUnit;
use SubjectBundle\Entity\StudentEntity;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="MarkBundle\Entity\Repository\MarkRepository")
 *
 * @ORM\Table(name="mark")
 */
class MarkEntity
{
    CONST VERBAL  = 1;
    CONST WRITTEN = 2;
    CONST SPECIAL = 3;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     * @var string
     */
    protected $mark;

    /**
     * @var integer
     * @ORM\Column(type="smallint")
     * @Constraints\Length(max="3", min="1")
     * @Constraints\NotBlank()
     */
    protected $type = 1;

    /**
     * @var TeachingUnit
     *
     * @ORM\ManyToOne(targetEntity="EducationCalendarBundle\Entity\TeachingUnit")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $teachingUnit;

    /**
     * @var StudentEntity
     *
     * @ORM\ManyToOne(targetEntity="SubjectBundle\Entity\StudentEntity")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $student;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @param string $mark
     *
     * @return $this
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return TeachingUnit
     */
    public function getTeachingUnit()
    {
        return $this->teachingUnit;
    }

    /**
     * @param TeachingUnit $teachingUnit
     *
     * @return $this
     */
    public function setTeachingUnit(TeachingUnit $teachingUnit)
    {
        $this->teachingUnit = $teachingUnit;

        return $this;
    }

    /**
     * @return StudentEntity
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param StudentEntity $student
     *
     * @return $this
     */
    public function setStudent(StudentEntity $student)
    {
        $this->student = $student;

        return $this;
    }
}