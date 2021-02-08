<?php

namespace App\Controller\Admin;

use App\Entity\Insulation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InsulationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Insulation::class;
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
