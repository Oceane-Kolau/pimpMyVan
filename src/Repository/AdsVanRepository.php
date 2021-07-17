<?php

namespace App\Repository;

use App\Entity\AdsVan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdsVan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdsVan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdsVan[]    findAll()
 * @method AdsVan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdsVanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdsVan::class);
    }

    /**
     * Recherche les annonces en fonction du formulaire
     * @return void 
     */
    public function search($mots = null, $specialtyVanArtisan = null){
        $query = $this->createQueryBuilder('a');
        $query->where('a.isValidated = 1');
        // if($mots != null){
        //     $query->andWhere('MATCH_AGAINST(a.title, a.description) AGAINST (:mots boolean)>0')
        //         ->setParameter('mots', $mots);
        // }
        if($specialtyVanArtisan != null){
            $query->leftJoin('a.specialtiesVan', 's')    
                  ->andWhere('s.id = :id')
                  ->setParameter('id', $specialtyVanArtisan);
        }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * Returns number of "Annonces" per day
    //  * @return void 
    //  */
    // public function countByDate(){
    //     // $query = $this->createQueryBuilder('a')
    //     //     ->select('SUBSTRING(a.created_at, 1, 10) as dateAnnonces, COUNT(a) as count')
    //     //     ->groupBy('dateAnnonces')
    //     // ;
    //     // return $query->getQuery()->getResult();
    //     $query = $this->getEntityManager()->createQuery("
    //         SELECT SUBSTRING(a.created_at, 1, 10) as dateAnnonces, COUNT(a) as count FROM App\Entity\Annonces a GROUP BY dateAnnonces
    //     ");
    //     return $query->getResult();
    // }

    // /**
    //  * Returns Annonces between 2 dates
    //  */
    // public function selectInterval($from, $to, $cat = null){
    //     // $query = $this->getEntityManager()->createQuery("
    //     //     SELECT a FROM App\Entity\Annonces a WHERE a.created_at > :from AND a.created_at < :to
    //     // ")
    //     //     ->setParameter(':from', $from)
    //     //     ->setParameter(':to', $to)
    //     // ;
    //     // return $query->getResult();
    //     $query = $this->createQueryBuilder('a')
    //         ->where('a.created_at > :from')
    //         ->andWhere('a.created_at < :to')
    //         ->setParameter(':from', $from)
    //         ->setParameter(':to', $to);
    //     if($cat != null){
    //         $query->leftJoin('a.categories', 'c')
    //             ->andWhere('c.id = :cat')
    //             ->setParameter(':cat', $cat);
    //     }
    //     return $query->getQuery()->getResult();
    // }

    /**
     * Returns all Annonces per page
     * @return void 
     */
    public function getPaginatedAnnonces($page, $limit, $filters = null){
        $query = $this->createQueryBuilder('a')
            ->where('a.isValidated = 1')
            ->leftJoin('a.specialtiesVan', 'specialtiesVanArtisan');

        // On filtre les données
        if($filters != null){
            $query
                ->andWhere('specialtiesVanArtisan IN(:specialtyVanArtisan)')
                ->setParameter(':specialtyVanArtisan', array_values($filters));
        }

        $query
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit);
            
        return $query->getQuery()->getResult();
    }

    /**
     * Returns number of Annonces
     * @return void 
     */
    public function getTotalAnnonces($filters = null){
        $query = $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->where('a.isValidated = 1');
        // On filtre les données
        if($filters != null){
            $query->andWhere('a.specialtiesVan IN(:specialtiesVanArtisan)')
                ->setParameter(':specialtiesVanArtisans', array_values($filters));
        }

        return $query->getQuery()->getSingleScalarResult();
    }
}