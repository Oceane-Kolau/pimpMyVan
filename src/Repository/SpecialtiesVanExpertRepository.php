<?php

namespace App\Repository;

use App\Entity\SpecialtiesVanExpert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialtiesVanExpert|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialtiesVanExpert|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialtiesVanExpert[]    findAll()
 * @method SpecialtiesVanExpert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialtiesVanExpertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialtiesVanExpert::class);
    }

    // /**
    //  * @return SpecialtiesVanExpert[] Returns an array of SpecialtiesVanExpert objects
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
    public function findOneBySomeField($value): ?SpecialtiesVanExpert
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
