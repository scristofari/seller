<?php

namespace App\DataFixtures;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("s.cristofari@gmail.com");
        $user->setUsername("Sylvain");
        $user->setPassword("test");
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user-1', $user);

        $user = new User();
        $user->setEmail("admin@admin.com");
        $user->setUsername("admin");
        $user->setPassword("admin");
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user-2', $user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
