<?php

namespace App\Repository;

use App\Entity\PersonnageNoyau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersonnageNoyau>
 */
class PersonnageNoyauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnageNoyau::class);
    }
}
