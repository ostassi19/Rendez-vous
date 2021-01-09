<?php

namespace App\Repository;

use App\Entity\RapportMedical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RapportMedical|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportMedical|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportMedical[]    findAll()
 * @method RapportMedical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportMedicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportMedical::class);
    }

    // /**
    //  * @return RapportMedical[] Returns an array of RapportMedical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RapportMedical
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
