<?php

namespace App\Repository;

use App\Data\SearchArtisansData;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function searchArtisans(SearchArtisansData $search)
    {
        $query = $this
            ->createQueryBuilder('user')
            ->innerJoin('user.specificSetup', 'specificSetup')
            ->innerJoin('user.region', 'region')
            ->innerJoin('user.specialtiesVanArtisan', 'specialtiesVanArtisan')
            ->innerJoin('user.generalSetup', 'generalSetup')
            ->where('user.roles LIKE :roles')
            ->setParameter('roles', '%"' . 'ROLE_ARTISAN' . '"%')
            ->andWhere('user.isValidated = 1');

        if (!empty($search->specificSetup)) {
            $query = $query
                ->andWhere('specificSetup.id IN (:specificSetup)')
                ->setParameter('specificSetup', $search->specificSetup);
        }

        if (!empty($search->generalSetup)) {
            $query = $query
                ->andWhere('generalSetup.id IN (:generalSetup)')
                ->setParameter('generalSetup', $search->generalSetup);
        }

        if (!empty($search->specialtiesVanArtisan)) {
            $query = $query
                ->andWhere('specialtiesVanArtisan.id IN (:specialtiesVanArtisan)')
                ->setParameter('specialtiesVanArtisan', $search->specialtiesVanArtisan);
        }

        if (!empty($search->region)) {
            $query = $query
                ->andWhere('region.id IN (:region)')
                ->setParameter('region', $search->region);
        }

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('user.companyName LIKE :q 
                OR user.description LIKE :q
                OR region.name LIKE :q
                OR generalSetup.type LIKE :q
                OR specificSetup.type LIKE :q
                OR specialtiesVanArtisan.type LIKE :q
                OR user.lastname LIKE :q
                OR user.firstname LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        return $query->getQuery()->getResult();
    }

    public function artisansHome()
    {
        return $this->createQueryBuilder('user')
            ->where('user.isValidated = 1')
            ->andWhere('user.roles LIKE :roles')
            ->setParameter('roles', '%"' . 'ROLE_ARTISAN' . '"%')
            ->orderby('user.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
    
}
