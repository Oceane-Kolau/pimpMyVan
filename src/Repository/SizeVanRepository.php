<?php

namespace App\Repository;

use App\Entity\SizeVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SizeVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method SizeVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method SizeVan[]    findAll()
 * @method SizeVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SizeVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SizeVan::class);
    }

    // /**
    //  * @return SizeVan[] Returns an array of SizeVan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SizeVan
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
