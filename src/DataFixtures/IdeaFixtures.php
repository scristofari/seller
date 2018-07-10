<?php

namespace App\DataFixtures;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class IdeaFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("s.cristofari@gmail.com");
        $user->setUsername("Sylvain");
        $user->setPassword("test");
        for ($i = 0; $i < 20; $i++) {
            $idea = new Idea();
            $idea->setTitle('idée '.$i);
            $idea->setUser($user);
            $manager->persist($idea);
        }

        $manager->flush();
    }
}