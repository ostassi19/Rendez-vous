<?php

namespace App\Repository;

use App\Entity\TypeSoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSoin[]    findAll()
 * @method TypeSoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSoin::class);
    }

    // /**
    //  * @return TypeSoin[] Returns an array of TypeSoin objects
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
    public function findOneBySomeField($value): ?TypeSoin
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
