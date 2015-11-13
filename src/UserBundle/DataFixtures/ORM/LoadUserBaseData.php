<?php

namespace UserBundle\DataFixtures\ORM;


use UserBundle\Entity\Profile;
use UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class LoadUserBaseData
 * @package UserBundle\DataFixtures\ORM
 */
class LoadUserBaseData extends UserDataLoader implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var string
     */
    protected $filename = 'users.json';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer ( ContainerInterface $container = null )
    {
        $this->container = $container;
    }


    protected function getRole($entityData)
    {
        $rolename = $entityData->Role;

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $repo = $em->getRepository('UserBundle:Role');

        $entityData->Role = $repo->findOneBy(array('role' => $rolename));
    }

    /**
     * @param string        $content
     * @param ObjectManager $objectManager
     */
    protected function loadUsers($content, ObjectManager $objectManager)
    {
        $users = json_decode($content);

        #$entityProfile = new Profile();
        $entityUser = new User();

        foreach($users as $entityName => $entityData)
        {
            switch($entityName) {
                #case 'profile':
                #    $this->fillEntity($entityProfile, $entityData);
                #    break;
                case 'user':
                    $this->getRole($entityData);
                    $this->fillEntity($entityUser, $entityData);
                    break;
            }
        }

        #$entityUser->setProfile($entityProfile);

        $objectManager->persist($entityUser);
        #$objectManager->persist($entityProfile);
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
        return 2; // the order in which fixtures will be loaded
    }
} 