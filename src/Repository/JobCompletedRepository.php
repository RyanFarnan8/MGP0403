<?php

namespace App\Repository;

use App\Entity\JobCompleted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobCompleted|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobCompleted|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobCompleted[]    findAll()
 * @method JobCompleted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobCompletedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobCompleted::class);
    }

    // /**
    //  * @return JobCompleted[] Returns an array of JobCompleted objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobCompleted
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
