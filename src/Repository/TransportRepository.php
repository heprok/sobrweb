<?php

namespace App\Repository;

use App\Entity\Trasnport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trasnport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trasnport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trasnport[]    findAll()
 * @method Trasnport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrasnportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trasnport::class);
    }

    // /**
    //  * @return Trasnport[] Returns an array of Trasnport objects
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
    public function findOneBySomeField($value): ?Trasnport
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
