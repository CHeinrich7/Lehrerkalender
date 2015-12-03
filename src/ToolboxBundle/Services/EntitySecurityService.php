<?php
/**
 * User: cheinrich
 * Date: 03.12.2015
 * Time: 11:01
 */

namespace ToolboxBundle\Services;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use UserBundle\Entity\Role;
use UserBundle\Entity\SoftdeletableEntity;
use UserBundle\Entity\User;

class EntitySecurityService
{
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $checker;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(AuthorizationCheckerInterface $checker, TokenStorageInterface $tokenStorage)
    {
        $this->checker      = $checker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param SoftdeletableEntity $entity
     *
     * @return bool
     */
    public function isEntityGranted(SoftdeletableEntity $entity)
    {
        $user = $this->getUser();

        if($user instanceof User !== true) {
            return false;
        }

        /*
         * if $entity is instanceof User:
         *     user can only edit itself
         * else
         *    User can only edit entities created by itself
         */
        if($entity instanceof User) {
            /** @var User $entityUser */
            $entityUser = $entity;
        }
        else {
            /** @var User $entityUser */
            $entityUser = $entity->getCreatedBy();
        }


        // entity->user::id === token->user::id?
        return ($entityUser->getId() === $user->getId());
    }

    public function isEntityGrantedWithAdminRights(SoftdeletableEntity $entity)
    {
        $isGranted = $this->isEntityGranted($entity);

        return $isGranted || $this->isGranted(Role::ROLE_ADMIN);
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return User|null
     */
    public function getUser()
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }

    /**
     * Checks if the attributes are granted against the current authentication token and optionally supplied object.
     *
     * @param mixed $attributes The attributes
     * @param mixed $object     The object
     *
     * @return bool
     */
    protected function isGranted($attributes, $object = null)
    {
        return $this->checker->isGranted($attributes, $object);
    }
}