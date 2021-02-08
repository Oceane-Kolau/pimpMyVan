<?php

namespace App\Repository;

use App\Entity\QuoteArtisan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuoteArtisan|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuoteArtisan|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuoteArtisan[]    findAll()
 * @method QuoteArtisan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteArtisanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuoteArtisan::class);
    }

    // /**
    //  * @return QuoteArtisan[] Returns an array of QuoteArtisan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuoteArtisan
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
