<?php

namespace App\Controller\Admin;

use App\Entity\BrandVan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BrandVanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BrandVan::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
