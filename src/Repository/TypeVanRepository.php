<?php

namespace App\Repository;

use App\Entity\TypeVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeVan[]    findAll()
 * @method TypeVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeVan::class);
    }

    // /**
    //  * @return TypeVan[] Returns an array of TypeVan objects
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
    public function findOneBySomeField($value): ?TypeVan
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
