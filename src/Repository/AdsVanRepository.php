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
            $query->leftJoin('a.specialtiesVanArtisan', 's')    
                  ->andWhere('s.id = :id')
                  ->setParameter('id', $specialtyVanArtisan);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * Returns all Annonces per page
     * @return void 
     */
    public function getPaginatedAnnonces($page, $limit, $filter = null){
        $query = $this->createQueryBuilder('adsVan')
            ->where('adsVan.isValidated = 1');
            
        // On filtre les données
        if($filter != null){
            $query
                ->innerJoin('adsVan.specialtiesVanArtisan', 's')
                ->andWhere('s.id IN (:specialtyVanArtisan)')
                ->setParameter(':specialtyVanArtisan', $filter);
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
    public function getTotalAnnonces($filter = null){
        $query = $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->where('a.isValidated = 1');
        // On filtre les données
        if($filter != null){
            
            $query  
                    ->innerJoin('a.specialtiesVanArtisan', 's')
                    ->andWhere('s.id IN (:specialtyVanArtisan)')
                    ->setParameter(':specialtyVanArtisan', $filter);
        }

        return $query->getQuery()->getSingleScalarResult();
    }
}