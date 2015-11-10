<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

use UserBundle\Entity\Profile;
use UserBundle\Entity\User;
use UserBundle\Entity\Role;

/**
 * Class LoadUserDummyData
 * @package UserBundle\DataFixtures\ORM
 */
class LoadUserDummyData extends LoadUserBaseData implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var string
     */
    protected $filename = 'dummyUsers.json';

    protected function getRole($entityData)
    {
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $repo = $em->getRepository('UserBundle:Role');

        $entityData->Role = $repo->findOneBy(array('role' => Role::ROLE_STAFF));
    }

    protected function loadUsers($content, ObjectManager $objectManager)
    {
        $users = json_decode($content);

        foreach($users as $user) {
            $this->loadUser($user, $objectManager);
        }
    }

    protected function setUserPassword(\stdClass $user, User $entityUser)
    {
        $factory = $this->container->get('security.encoder_factory');

        $encoder = $factory->getEncoder($entityUser);
        $user->Salt = md5(time());
        $user->Password = $encoder->encodePassword('test', $user->Salt);
    }

    /**
     * @param \stdClass     $user
     * @param ObjectManager $objectManager
     */
    protected function loadUser($user, ObjectManager $objectManager)
    {
        $entityProfile = new Profile();
        $entityUser = new User();

        $this->setUserPassword($user->user, $entityUser);

        foreach($user as $entityName => $entityData)
        {
            switch($entityName) {
                case 'profile':
                    $this->fillEntity($entityProfile, $entityData);
                    break;
                case 'user':
                    $this->getRole($entityData, $objectManager);
                    $this->fillEntity($entityUser, $entityData);
                    break;
            }
        }

        $entityUser->setProfile($entityProfile);

        $objectManager->persist($entityUser);
        $objectManager->persist($entityProfile);
    }

    /**
     * @param ObjectManager $objectManager
     *
     * @throws FileNotFoundException
     */
    public function load(ObjectManager $objectManager)
    {
        $content = $this->getFileContent($this->filename);

        if($content === false) {
            throw new FileNotFoundException('File \'' . $this->filename . '\' cannot be found');
        }

        $this->loadUsers($content, $objectManager);

        $objectManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}