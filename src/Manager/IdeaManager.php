<?php

namespace App\Manager;

use App\Entity\Idea;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

/**
 * Class IdeaManager
 *
 * @package App\Manager
 */
class IdeaManager
{

    /** @var EntityManager */
    private $em;

    public function __constructor(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Create the idea.
     *
     * @param \App\Entity\Idea $idea
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Idea $idea)
    {
        $this->em->persist($idea);
        $this->em->flush();
    }
}