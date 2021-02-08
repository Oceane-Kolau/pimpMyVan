<?php

namespace App\Controller\Admin;

use App\Entity\Floor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FloorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Floor::class;
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
