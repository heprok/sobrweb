<?php

namespace App\Repository;

use App\Entity\Gost2708;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gost2708|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gost2708|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gost2708[]    findAll()
 * @method Gost2708[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Gost2708Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gost2708::class);
    }

    // /**
    //  * @return Gost2708[] Returns an array of Gost2708 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gost2708
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
