<?php

namespace App\Repository;

use App\Entity\Idea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class IdeaRepository
 *
 * @package App\Repository
 */
class IdeaRepository extends ServiceEntityRepository
{

    /**
     * IdeaRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Idea::class);
    }
}
