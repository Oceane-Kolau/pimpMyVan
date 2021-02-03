<?php

namespace App\Repository;

use App\Entity\GeneralSetup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralSetup|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralSetup|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralSetup[]    findAll()
 * @method GeneralSetup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralSetupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralSetup::class);
    }

    // /**
    //  * @return GeneralSetup[] Returns an array of GeneralSetup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneralSetup
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
