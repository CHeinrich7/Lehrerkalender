<?php
/**
 * User: cheinrich
 * Date: 10.11.2015
 * Time: 11:52
 */

namespace EducationCalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Table(name="calendar_day")
 */
class CalendarDay
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
     * @OMR\Clolumn(type="date")
     * @ORM\Date
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * @var ArrayCollection
     */
    protected $teachingUnits;

    public function __construct()
    {
        $this->teachingUnits = new ArrayCollection();
    }

    /**
     * @return integer
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
     * @return ArrayCollection
     */
    public function getTeachingUnits()
    {
        return $this->teachingUnits;
    }

    /**
     * @param ArrayCollection $teachingUnits
     *
     * @return $this
     */
    public function setTeachingUnits($teachingUnits)
    {
        $this->teachingUnits = $teachingUnits;

        return $this;
    }
}