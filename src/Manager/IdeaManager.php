<?php

namespace App\Manager;

use App\Entity\Idea;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class IdeaManager
 *
 * @package App\Manager
 */
class IdeaManager
{
    /** @var EntityManager */
    private $em;

    /** @var IdeaRepository */
    private $repository;

    public function __constructor(EntityManager $em, IdeaRepository $ir) {
        $this->em = $em;
        $this->repository = $ir;
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

    /**
     * Find an idea by slug.
     *
     * @param \App\Entity\Idea $idea
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws EntityNotFoundException
     *
     * @return Idea
     */
    public function findBySlug($slug)
    {
        $idea = $this->repository->findOneBySlug($slug);
        if (null === $idea) {
            throw new EntityNotFoundException("Idea not found");
        }

        return $idea;
    }
}