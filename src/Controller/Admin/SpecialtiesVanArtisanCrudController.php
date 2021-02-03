<?php

namespace App\Controller\Admin;

use App\Entity\SpecialtiesVanArtisan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpecialtiesVanArtisanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpecialtiesVanArtisan::class;
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
