<?php

namespace App\Controller\Admin;

use App\Entity\BrandVan;
use App\Entity\GeneralSetup;
use App\Entity\SizeVan;
use App\Entity\SpecialtiesVanExpert;
use App\Entity\Town;
use App\Entity\TypeVan;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin")
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pimp My Van');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Gestion des catégories', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Marques', 'far fa-copyright', BrandVan::class)
            ->setController(BrandVanCrudController::class),
            MenuItem::linkToCrud('Tailles', 'fas fa-border-style', SizeVan::class)
            ->setController(SizeVanCrudController::class),
            MenuItem::linkToCrud('Types', 'fas fa-shuttle-van', TypeVan::class)
            ->setController(TypeVanCrudController::class),
            MenuItem::linkToCrud('Villes', 'fas fa-map-pin', Town::class)
            ->setController(TownCrudController::class),
            MenuItem::linkToCrud('Spécialités', 'fas fa-plus-circle', SpecialtiesVanExpert::class)
            ->setController(SpecialtiesVanExpertCrudController::class),
            MenuItem::linkToCrud('Aménagement général', 'fas fa-wrench', GeneralSetup::class)
            ->setController(GeneralSetupCrudController::class),
            MenuItem::linkToCrud('Types d\'aménagement', 'fas fa-ruler-combined', SpecificSetup::class)
            ->setController(SpecificSetupCrudController::class),
        ]);

        yield MenuItem::subMenu('Modération', 'fas fa-check-square')->setSubItems([
            MenuItem::linkToCrud('Experts', 'fas fa-user-cog', User::class)
            ->setController(ModerationExpertController::class),
        ]);

        yield MenuItem::subMenu('Infos', 'fas fa-info')->setSubItems([
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)
            ->setController(UserCrudController::class),
        ]);
        
    }
}
