<?php

namespace App\Repository;

use App\Entity\Internship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Internship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Internship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Internship[]    findAll()
 * @method Internship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Internship::class);
    }

    public function countInternShips(): int
    {
        return $this->createQueryBuilder('i')
            ->select('COUNT(i.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
