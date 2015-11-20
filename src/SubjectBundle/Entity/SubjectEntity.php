<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 12:55
 */

namespace SubjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\SoftdeletableEntity;

/**
 * @ORM\Entity(repositoryClass="SubjectBundle\Entity\Repository\SubjectRepository")
 *
 * @ORM\Table(
 *     name="subject",
 *     uniqueConstraints={@ORM\UniqueConstraint(
 *          name="user_class_subject",
 *          columns={"name", "education_class_id", "created_by_id"}
 *      )}
 * )
 */
class SubjectEntity extends SoftdeletableEntity
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
     * @var string
     *
     * @ORM\Column(name="name")
     * @Constraints\Length(max="5")
     */
    protected $name;

    /**
     * @var EducationClassEntity
     *
     * @ORM\ManyToOne(targetEntity="EducationClassEntity")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $educationClass;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EducationCalendarBundle\Entity\TeachingUnit", mappedBy="subject")
     * @ORM\OrderBy({"date" = "DESC"})
     */
    protected $teachingUnits;


    public function __construct()
    {
        $this->teachingUnits = new ArrayCollection();
    }

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
     * @return Collection
     */
    public function getTeachingUnits()
    {
        return $this->teachingUnits;
    }

    /**
     * @param Collection $teachingUnits
     *
     * @return $this
     */
    public function setTeachingUnits($teachingUnits)
    {
        $this->teachingUnits = $teachingUnits;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameWithEducationClassName()
    {
        return $this->getEducationClass()->getName() . ' - ' . $this->getName();
    }
}