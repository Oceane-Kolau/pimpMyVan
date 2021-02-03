<?php

namespace App\Controller\Admin;

use App\Entity\SpecificSetup;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpecificSetupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpecificSetup::class;
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
