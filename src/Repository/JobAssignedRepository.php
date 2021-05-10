<?php

namespace App\Repository;

use App\Entity\JobAssigned;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobAssigned|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobAssigned|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobAssigned[]    findAll()
 * @method JobAssigned[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobAssignedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobAssigned::class);
    }

    // /**
    //  * @return JobAssigned[] Returns an array of JobAssigned objects
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
    public function findOneBySomeField($value): ?JobAssigned
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
