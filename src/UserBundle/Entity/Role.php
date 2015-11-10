<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="UserBundle\Entity\Repository\RoleRepository")
 * @ORM\Table(name="userrole")
 *
 * @UniqueEntity(fields="role", message="There can not be one Role twice in Database!")
 */
class Role
{
    const ROLE_APPLICANT    = 'ROLE_APPLICANT';
    const ROLE_STAFF        = 'ROLE_STAFF';
    const ROLE_CHARGER      = 'ROLE_CHARGER';
    const ROLE_ADMIN        = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN  = 'ROLE_SUPER_ADMIN';


    public function __construct ( $role )
    {
        $this->role = $role;
    }

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=16)
     * @Constraints\NotBlank()
     * @var string
     */
    protected $role;

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $role
     *
     * @return Role
     */
    public function setRole ( $role )
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole ()
    {
        return $this->role;
    }
}