<?php

namespace App\Repository;

use App\Entity\Downtime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Tlc\ManualBundle\Repository\DowntimeRepository as RepositoryDowntimeRepository;

/**
 * @method Downtime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Downtime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Downtime[]    findAll()
 * @method Downtime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DowntimeRepository extends RepositoryDowntimeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $this->nameClass = Downtime::class;
        parent::__construct($registry);
    }

    // /**
    //  * @return Downtime[] Returns an array of Downtime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Downtime
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
