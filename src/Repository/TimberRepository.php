<?php

namespace App\Repository;

use App\Entity\Timber;
use DatePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Timber|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timber|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timber[]    findAll()
 * @method Timber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timber::class);
    }

    /**
     * Подготавливает запрос для периода
     *
     * @param DatePeriod $period
     * @return QueryBuilder
     */
    private function getBaseQueryFromPeriod(DatePeriod $period, array $sqlWhere = []): QueryBuilder
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.drecTimestampKey BETWEEN :start AND :end')
            ->setParameter('start', $period->getStartDate()->format(DATE_RFC3339_EXTENDED))
            ->setParameter('end', $period->end ? $period->getEndDate()->format(DATE_RFC3339_EXTENDED) : date(DATE_RFC3339_EXTENDED))
            ->leftJoin('t.species', 's');

        foreach ($sqlWhere as $where) {
            $query = $where->nameTable . $where->id . ' ' . $where->operator . ' ' . $where->value;
            if ($where->logicalOperator == 'AND')
                $qb->andWhere($query);
            else
                $qb->orWhere($query);
        }
        return $qb;
    }

    /**
     * @return Timber[]
     */
    public function findByPeriod(DatePeriod $period, array $sqlWhere = []): array
    {
        return $this->getBaseQueryFromPeriod($period, $sqlWhere)
            ->addSelect('volume_timber(t.length, t.mid_diam) as volume_timber')
            ->addSelect('standard_length(t.length) as standart_length')
            ->setMaxResults(1000)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Batch[] Returns an array of Timber objects
     */
    public function findBatchByPeriod(DatePeriod $period): array
    {
        return $this->getBaseQueryFromPeriod($period)
            ->select('b')
            ->leftJoin('App:Batch', 'b', \Doctrine\ORM\Query\Expr\Join::WITH, 't.batch = b.id')
            ->groupBy('b')
            ->orderBy('b.id')
            ->getQuery()
            ->getResult();
    }
    
    public function getReportTimberByPeriod(DatePeriod $period, array $sqlWhere =[])
    {
        $qb = $this->getBaseQueryFromPeriod($period, $sqlWhere);
        return $qb
            ->select(
                's.name AS name_species',
                't.mid_diam AS diam',
                't.quality AS quality',
                'standard_length(t.length) AS st_length',
                'count(1) AS count_timber',
                'sum(volume_timber(t.length, t.mid_diam)) AS volume_timber'
            )
            ->addOrderBy('name_species, quality, diam, st_length')
            ->addGroupBy('name_species', 'quality', 'diam', 'st_length')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Timber[] Returns an array of Timber objects
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
    public function findOneBySomeField($value): ?Timber
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
