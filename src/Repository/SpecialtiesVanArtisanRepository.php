<?php

namespace App\Repository;

use App\Entity\SpecialtiesVanArtisan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialtiesVanArtisan|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialtiesVanArtisan|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialtiesVanArtisan[]    findAll()
 * @method SpecialtiesVanArtisan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialtiesVanArtisanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialtiesVanArtisan::class);
    }

    // /**
    //  * @return SpecialtiesVanArtisan[] Returns an array of SpecialtiesVanArtisan objects
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
    public function findOneBySomeField($value): ?SpecialtiesVanArtisan
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
