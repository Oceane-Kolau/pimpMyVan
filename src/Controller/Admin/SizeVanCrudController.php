<?php

namespace App\Controller\Admin;

use App\Entity\SizeVan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SizeVanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SizeVan::class;
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
