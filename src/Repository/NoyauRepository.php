<?php

namespace App\Repository;

use App\Entity\Noyau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Noyau>
 */
class NoyauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noyau::class);
    }

    public function findAllGroupedByEnsemble(): array
    {
        return $this->createQueryBuilder('n')
            ->leftJoin('n.ensemble', 'e')
            ->addSelect('e')
            ->orderBy('e.nom', 'ASC')
            ->addOrderBy('n.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
