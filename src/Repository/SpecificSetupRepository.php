<?php

namespace App\Repository;

use App\Entity\SpecificSetup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecificSetup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecificSetup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecificSetup[]    findAll()
 * @method SpecificSetup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecificSetupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecificSetup::class);
    }

    // /**
    //  * @return SpecificSetup[] Returns an array of SpecificSetup objects
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
    public function findOneBySomeField($value): ?SpecificSetup
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
