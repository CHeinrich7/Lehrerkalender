<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:56
 */

namespace SubjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\SoftdeletableEntity;

/**
 * @ORM\Entity(repositoryClass="SubjectBundle\Entity\Repository\StudentRepository")
 *
 * @ORM\Table(name="student")
 */
class StudentEntity extends SoftdeletableEntity
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
     * @var EducationClassEntity
     *
     * @ORM\ManyToOne(targetEntity="EducationClassEntity")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $educationClass;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=true)
     */
    protected $lastname;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $isSuspended = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $entered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $caved;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MarkBundle\Entity\MarkEntity", mappedBy="teachingUnit")
     * @ORM\OrderBy({"mark" = "ASC"})
     */
    protected $marks;

    public function __construct()
    {
        $this->marks = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return EducationClassEntity
     */
    public function getEducationClass()
    {
        return $this->educationClass;
    }

    /**
     * @param EducationClassEntity $educationClass
     *
     * @return $this
     */
    public function setEducationClass($educationClass)
    {
        $this->educationClass = $educationClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     *
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     *
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsSuspended()
    {
        return $this->isSuspended;
    }

    /**
     * @param boolean $isSuspended
     *
     * @return $this
     */
    public function setIsSuspended($isSuspended)
    {
        $this->isSuspended = $isSuspended;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEntered()
    {
        return $this->entered;
    }

    /**
     * @param \DateTime $entered
     *
     * @return $this
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCaved()
    {
        return $this->caved;
    }

    /**
     * @param \DateTime $caved
     *
     * @return $this
     */
    public function setCaved($caved)
    {
        $this->caved = $caved;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * @param Collection $marks
     *
     * @return $this
     */
    public function setMarks(Collection $marks)
    {
        $this->marks = $marks;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return trim($this->firstname . ' ' . $this->lastname);
    }
}