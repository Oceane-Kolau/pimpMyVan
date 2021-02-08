<?php

namespace App\Controller\Admin;

use App\Entity\YearVan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class YearVanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return YearVan::class;
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
