<?php

namespace App\DataFixtures;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class IdeaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var User $user */
        $user = $this->getReference('user-1');

        for ($i = 0; $i < 10; $i++) {
            $idea = new Idea();
            $idea->setTitle('idée '.$i);
            $idea->setUser($user);
            $manager->persist($idea);
        }

        $manager->flush();

        /** @var User $user */
        $user = $this->getReference('user-2');

        for ($i = 0; $i < 10; $i++) {
            $idea = new Idea();
            $idea->setTitle('idée - '.$i);
            $idea->setUser($user);
            $manager->persist($idea);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
