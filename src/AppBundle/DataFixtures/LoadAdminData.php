<?php

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAdminData extends Fixture implements \Symfony\Component\DependencyInjection\ContainerAwareInterface
{

     /**
     * @var ContainerInterface
     */
    private $container;


     /**
     * Sets the container.
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
    $this->container = $container;
    }


     /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    $userManager = $this->container->get('fos_user.user_manager');
    
    $user = $userManager->createUser();
    $user->setUsername('testadmin');
    $user->setEmail('admin@admin.com');
    $user->setPlainPassword('testadmin');
    $user->setEnabled(true);
    $user->addRole('ROLE_ADMIN');
    $userManager->updateUser($user);
    }
}