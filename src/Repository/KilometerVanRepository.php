<?php

namespace App\Repository;

use App\Entity\KilometerVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KilometerVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method KilometerVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method KilometerVan[]    findAll()
 * @method KilometerVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KilometerVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KilometerVan::class);
    }

    // /**
    //  * @return KilometerVan[] Returns an array of KilometerVan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KilometerVan
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
