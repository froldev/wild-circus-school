<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findAdmin(): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%'.User::ROLE_ADMIN.'%')
            ->orderBy('u.lastName')
            ->getQuery()
            ->getResult()
            ;
    }

    public function countAdmin(): int
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%'.User::ROLE_ADMIN.'%')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function findUser(): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles NOT LIKE :role')
            ->setParameter('role', '%'.User::ROLE_ADMIN.'%')
            ->orderBy('u.lastName')
            ->getQuery()
            ->getResult()
            ;
    }

    public function countUser(): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles NOT LIKE :role')
            ->setParameter('role', '%'.User::ROLE_ADMIN.'%')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
