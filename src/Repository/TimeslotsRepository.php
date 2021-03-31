<?php

namespace App\Repository;

use App\Entity\Timeslots;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Timeslots|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timeslots|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timeslots[]    findAll()
 * @method Timeslots[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeslotsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timeslots::class);
    }

    // /**
    //  * @return Timeslots[] Returns an array of Timeslots objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Timeslots
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
