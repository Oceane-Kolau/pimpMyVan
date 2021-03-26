<?php

namespace App\Controller\Admin\Moderation;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ModerationArtisanController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('isValidated', "Validation"),
            Field::new('firstname', "Prénom"),
            Field::new('lastname', "Nom"),
            Field::new('email', "Email"),
            Field::new('phone', "Téléphone")->hideOnIndex(),
            Field::new('description', "Description")->hideOnIndex(),
            Field::new('companyName', "Nom de l'entreprise"),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
        ;
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $search = $searchDto->getQuery();
        $response->andwhere('entity.isValidated = 0');
        if (isset($search) && !empty($search)) {
            $response->andWhere("entity.lastname LIKE :search 
            OR entity.firstname LIKE :search 
            OR entity.email LIKE :search
            OR entity.companyName LIKE :search
            ")
            ->setParameter('search', '%' . $search . '%');
        }

        return $response;
    }
}