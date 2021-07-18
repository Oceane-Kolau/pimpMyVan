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
     * Returns all Annonces per page
     * @return void 
     */
    public function getPaginatedAnnonces($s = null, $i = null, $f = null, $v = null){
        $query = $this->createQueryBuilder('adsVan')             
                ->where('adsVan.isValidated = 1');
        
        // On filtre les données
        if($s != null){
            
            $query = $query
                        ->innerJoin('adsVan.specialtiesVanArtisan', 'specialtiesVanArtisan')
                        ->andWhere('specialtiesVanArtisan.id = :specialtyVanArtisan')
                        ->setParameter(':specialtyVanArtisan', array($s));
        }

        if($i != null){
            $query = $query
                        ->innerJoin('adsVan.insulation', 'insulation')
                        ->andWhere('insulation.id = :insulation')
                        ->setParameter(':insulation', array($i));

        }

        if($f != null){
            $query = $query
                        ->innerJoin('adsVan.vanFurnishing', 'vanFurnishing')
                        ->andWhere('vanFurnishing.id = :vanFurnishing')
                        ->setParameter(':vanFurnishing', array($f));
        }

        if($v != null){
            $query = $query
                        ->join('adsVan.veneer', 'veneer')
                        ->andWhere('veneer.id = :veneer')
                        ->setParameter(':veneer', array($v));
        }
        
        return $query->getQuery()->getResult();
    }
}