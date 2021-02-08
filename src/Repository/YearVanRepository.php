<?php

namespace App\Repository;

use App\Entity\YearVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method YearVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method YearVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method YearVan[]    findAll()
 * @method YearVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YearVan::class);
    }

    // /**
    //  * @return YearVan[] Returns an array of YearVan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?YearVan
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
