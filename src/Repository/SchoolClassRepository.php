<?php

namespace App\Repository;

use App\Entity\SchoolClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SchoolClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolClass[]    findAll()
 * @method SchoolClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolClass::class);
    }

    public function countClasses(): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
