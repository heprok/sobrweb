<?php

namespace App\Repository;

use App\Entity\TimberQuality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TimberQuality|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimberQuality|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimberQuality[]    findAll()
 * @method TimberQuality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimberQualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimberQuality::class);
    }

    // /**
    //  * @return TimberQuality[] Returns an array of TimberQuality objects
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
    public function findOneBySomeField($value): ?TimberQuality
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
