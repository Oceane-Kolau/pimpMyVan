<?php

namespace App\Repository;

use App\Entity\Veneer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Veneer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Veneer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Veneer[]    findAll()
 * @method Veneer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VeneerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Veneer::class);
    }

    // /**
    //  * @return Veneer[] Returns an array of Veneer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Veneer
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
