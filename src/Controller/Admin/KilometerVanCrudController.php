<?php

namespace App\Controller\Admin;

use App\Entity\KilometerVan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class KilometerVanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return KilometerVan::class;
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
