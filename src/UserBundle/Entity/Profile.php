<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;

/**
 * @ORM\Entity(repositoryClass="UserBundle\Entity\Profile")
 * @ORM\Table(name="userprofile")
 */
class Profile
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @var boolean
     */
    protected $isActive = true;

    /**
     * @ORM\Column(name="is_deleted", type="boolean")
     * @var boolean
     */
    protected $isDeleted = false;

    /**
     * @ORM\OneToOne(targetEntity="User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(referencedColumnName="id")
     * @Constraints\Valid
     * @var User
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=50, nullable = false)
     * @Constraints\NotBlank()
     * @Constraints\Email()
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=50, nullable = false)
     * @Constraints\NotBlank()
     * @var string
     */
    protected $number;

    /**
     * @ORM\Column(type="string", length=50, nullable = true)
     * @var string
     */
    protected $number2  = null;

    /**
     * @ORM\Column(type="string", length=50)
     * @Constraints\NotBlank()
     * @var string
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Constraints\NotBlank()
     * @var string
     */
    protected $lastname;

    /**
     * @ORM\Column(name="show_mail", type="boolean", options={"default"=0})
     * @var boolean
     */
    protected $showMail = false;

    /**
     * @ORM\Column(name="image", type="string", nullable = true)
     * @var string
     */
    protected $image = null;

    /**
     * @param string $email
     *
     * @return Profile
     */
    public function setEmail ( $email )
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail ()
    {
        return $this->email;
    }

    /**
     * @param string $firstname
     *
     * @return Profile
     */
    public function setFirstname ( $firstname )
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname ()
    {
        return $this->firstname;
    }

    /**
     * @param integer $id
     *
     * @return Profile
     */
    public function setId ( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param boolean $isActive
     *
     * @return Profile
     */
    public function setIsActive ( $isActive )
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return Profile
     */
    public function getIsActive ()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isDeleted
     *
     * @return Profile
     */
    public function setIsDeleted ( $isDeleted )
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDeleted ()
    {
        return $this->isDeleted;
    }

    /**
     * @param string $lastname
     *
     * @return Profile
     */
    public function setLastname ( $lastname )
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname ()
    {
        return $this->lastname;
    }

    /**
     * @param string $number
     *
     * @return Profile;
     */
    public function setNumber ( $number )
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber ()
    {
        return $this->number;
    }

    /**
     * @param string $number2
     *
     * @return Profile;
     */
    public function setNumber2 ( $number2 )
    {
        $this->number2 = $number2;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber2 ()
    {
        return $this->number2;
    }

    /**
     * @param boolean $showMail
     *
     * @return Profile;
     */
    public function setShowMail ( $showMail )
    {
        $this->showMail = $showMail;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getShowMail ()
    {
        return $this->showMail;
    }

    /**
     * @param User $user
     *
     * @return Profile;
     */
    public function setUser ( $user )
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * @param string $image
     *
     * @return Profile;
     */
    public function setImage ( $image )
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage ()
    {
        return $this->image;
    }
} 