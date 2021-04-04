<?php

namespace App\Controller\Admin;

use App\Entity\AdsVan;
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

class ModerationAdsVanController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdsVan::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('isValidated', "Validation"),
            Field::new('title', "Titre"),
            Field::new('description', "Description")
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
            $response->andWhere("entity.title LIKE :search 
            OR entity.title LIKE :search 
            OR entity.user LIKE :search
            ")
            ->setParameter('search', '%' . $search . '%');
        }

        return $response;
    }
}