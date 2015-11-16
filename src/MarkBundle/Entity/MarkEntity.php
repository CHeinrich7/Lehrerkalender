<?php
/**
 * User: cheinrich
 * Date: 16.11.2015
 * Time: 14:01
 */

namespace MarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="MarkBundle\Entity\Repository\MarkRepository")
 *
 * @ORM\Table(name="mark")
 */
class MarkEntity
{
    CONST MUENDLICH      = 1;
    CONST SCHRIFTLICH    = 2;
    CONST SONDERLEISTUNG = 3;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=5)
     * @var string
     */
    protected $mark;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $type;

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
}