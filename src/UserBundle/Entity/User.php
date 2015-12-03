<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\SoftDeleteable;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="UserBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 * @UniqueEntity(fields="username", message="There can not be one User twice in Database!")
 */
class User extends SoftdeletableEntity implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Constraints\NotBlank()
     * @Constraints\Length(min = "5")
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=32, nullable = false)
     */
    protected $salt = null;

    /**
     * algorithm: sha512
     * encode_as_base64: true
     *
     * @ORM\Column(type="string", length=128, nullable = false)
     * @Constraints\Length(min = "5")
     * @Constraints\NotBlank()
     */
    protected $password;

    /**
     * @ORM\Column(name="is_superuser", type="boolean", options={"default" = 0})
     */
    protected $isSuperUser = false;

    /**
     * @ORM\Column(name="is_active", type="boolean", options={"default" = 1})
     */
    protected $isActive  = true;

    /**
     * @ORM\Column(name="is_deletable", type="boolean", options={"default" = 1})
     */
    protected $isDeletable = true;

    /**
     * @var string
     */
    protected $plainPassword = null;

//    /**
//     * @ORM\OneToOne(targetEntity="Profile", cascade={"persist", "remove"})
//     * @Constraints\Valid
//     */
//    protected $profile;

    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @Constraints\Valid
     * @var Role
     */
    protected $role;

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
     * @return User
     */
    public function setIsActive ( $isActive )
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive ()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isDeletable
     *
     * @return User
     */
    public function setIsDeletable ( $isDeletable )
    {
        $this->isDeletable = $isDeletable;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDeletable ()
    {
        return $this->isDeletable;
    }

    /**
     * @param boolean $isSuperUser
     *
     * @return User
     */
    public function setIsSuperUser ( $isSuperUser )
    {
        $this->isSuperUser = $isSuperUser;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsSuperUser ()
    {
        return $this->isSuperUser;
    }

    /**
     * @return string
     */
    public function getSalt ()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt ($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword ( $password )
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword ()
    {
        return $this->password;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword ( $plainPassword )
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword ()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername ( $username )
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername ()
    {
        return $this->username;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles ()
    {
        return array( $this->role->getRole() );
    }

    public function getRole ()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     *
     * @return User
     */
    public function setRole ($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials ()
    {
        // TODO: Implement eraseCredentials() method.
    }
}