<?php

namespace App\Repository;

use App\Entity\Artist;
use App\Entity\SchoolClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    public function countArtists(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function findArtistsByClass(SchoolClass $schoolClass): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.schoolClass', 'c')
            ->addSelect('a')
            ->where('a.id = :class')
            ->setParameters([
                'class' => $schoolClass->getId(),
            ])
            ->orderBy('a.name')
            ->getQuery()
            ->getResult()
            ;
    }
}
