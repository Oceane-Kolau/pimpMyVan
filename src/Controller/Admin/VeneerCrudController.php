<?php

namespace App\Controller\Admin;

use App\Entity\Veneer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VeneerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Veneer::class;
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
