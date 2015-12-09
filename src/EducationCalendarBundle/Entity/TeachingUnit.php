<?php
/**
 * User: cheinrich
 * Date: 10.11.2015
 * Time: 11:52
 */

namespace EducationCalendarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use SubjectBundle\Entity\SubjectEntity;
use Symfony\Component\Validator\Constraints;
use UserBundle\Entity\SoftdeletableEntity;


/**
 * @ORM\Entity(repositoryClass="EducationCalendarBundle\Entity\Repository\TeachingUnitRepository")
 *
 * @ORM\Table(name="teaching_unit")
 */
class TeachingUnit extends SoftdeletableEntity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @Constraints\Date
     * @Constraints\NotNull()
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * @var integer
     * @ORM\Column(type="smallint", nullable=false)
     * @Constraints\NotBlank()
     */
    protected $unitBlock;


    /**
     * @var SubjectEntity
     *
     * @ORM\ManyToOne(targetEntity="SubjectBundle\Entity\SubjectEntity", inversedBy="teachingUnits")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="notice", type="string", nullable=true)
     */
    protected $notice;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", nullable=true)
     */
    protected $content;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MarkBundle\Entity\MarkEntity", mappedBy="teachingUnit")
     * @ORM\OrderBy({"mark" = "ASC"})
     */
    protected $marks;


    /**
     * @var string
     *
     * @ORM\Column(name="room", type="string", nullable=true)
     * @Constraints\Length(max="5")
     */
    protected $room;

    /**
     */
    public function __construct()
    {
        $this->marks = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnitBlock()
    {
        return $this->unitBlock;
    }

    /**
     * @param int $unitBlock
     *
     * @return $this
     */
    public function setUnitBlock($unitBlock)
    {
        $this->unitBlock = $unitBlock;

        return $this;
    }

    /**
     * @return SubjectEntity
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param SubjectEntity $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param string $notice
     *
     * @return $this
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param string $room
     *
     * @return $this
     */
    public function setRoom($room)
    {
        $this->room = $room;

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
}