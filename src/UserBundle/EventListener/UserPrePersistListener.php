<?php
/**
 * User: cheinrich
 * Date: 09.12.2015
 * Time: 11:22
 */

namespace UserBundle\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use UserBundle\Entity\User;

class UserPrePersistListener implements EventSubscriber
{
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof User && $entity->getIsSuperUser()) {
            throw new \Exception('Entity cannot be deleted');
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return ['preRemove'];
    }
}