<?php

namespace App\Repository;

use App\Entity\AdsVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdsVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdsVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdsVan[]    findAll()
 * @method AdsVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdsVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdsVan::class);
    }

    // /**
    //  * @return AdsVan[] Returns an array of AdsVan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdsVan
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
