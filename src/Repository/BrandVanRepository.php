<?php

namespace App\Repository;

use App\Entity\BrandVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrandVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandVan[]    findAll()
 * @method BrandVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandVan::class);
    }

    // /**
    //  * @return BrandVan[] Returns an array of BrandVan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrandVan
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
