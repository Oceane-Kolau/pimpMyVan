<?php

namespace App\Controller\Admin;

use App\Entity\TypeVan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeVanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeVan::class;
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
