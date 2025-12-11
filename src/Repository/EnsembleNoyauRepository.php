<?php

namespace App\Repository;

use App\Entity\EnsembleNoyau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnsembleNoyau>
 */
class EnsembleNoyauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnsembleNoyau::class);
    }
}
