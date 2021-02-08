<?php

namespace App\Repository;

use App\Entity\VanFurnishing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VanFurnishing|null find($id, $lockMode = null, $lockVersion = null)
 * @method VanFurnishing|null findOneBy(array $criteria, array $orderBy = null)
 * @method VanFurnishing[]    findAll()
 * @method VanFurnishing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VanFurnishingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VanFurnishing::class);
    }

    // /**
    //  * @return VanFurnishing[] Returns an array of VanFurnishing objects
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
    public function findOneBySomeField($value): ?VanFurnishing
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
