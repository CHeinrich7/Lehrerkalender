<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:29
 */
namespace SubjectBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use UserBundle\Entity\SoftdeletableEntity;

/**
 * @ORM\Entity(repositoryClass="SubjectBundle\Entity\Repository\EducationClassRepository")
 *
 * @ORM\Table(name="education_class")
 */
class EducationClassEntity extends SoftdeletableEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SubjectEntity", mappedBy="educationClass")
     */
    protected $subjects;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="StudentEntity", mappedBy="educationClass")
     */
    protected $students;
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     */
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param ArrayCollection $subjects
     *
     * @return $this
     */
    public function setSubjects(Collection $subjects)
    {
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param ArrayCollection $students
     *
     * @return $this
     */
    public function setStudents(Collection $students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}