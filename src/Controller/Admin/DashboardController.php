<?php

namespace App\Controller\Admin;

use App\Entity\AdsVan;
use App\Entity\BrandVan;
use App\Entity\Floor;
use App\Entity\GeneralSetup;
use App\Entity\Insulation;
use App\Entity\KilometerVan;
use App\Entity\SizeVan;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\Region;
use App\Entity\TypeVan;
use App\Entity\User;
use App\Entity\VanFurnishing;
use App\Entity\Veneer;
use App\Entity\YearVan;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
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
        
        yield MenuItem::subMenu('Modération', 'fas fa-check-square')->setSubItems([
            MenuItem::linkToCrud('Artisans', 'fas fa-user-cog', User::class)
            ->setController(ModerationArtisanController::class),
            MenuItem::linkToCrud('Annonces de Van', 'fas fa-user-cog', AdsVan::class)
            ->setController(ModerationAdsVanController::class),
        ]);

        yield MenuItem::subMenu('Infos', 'fas fa-info')->setSubItems([
            MenuItem::linkToCrud('Utilisateurs inscrits', 'fas fa-user', User::class)
            ->setController(UserCrudController::class),
            MenuItem::linkToCrud('Annonces en ligne', 'fas fa-user', AdsVan::class)
            ->setController(AdsVanCrudController::class),
        ]);

        yield MenuItem::subMenu('Gestion des catégories', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Marques', 'far fa-copyright', BrandVan::class)
            ->setController(BrandVanCrudController::class),
            MenuItem::linkToCrud('Tailles', 'fas fa-border-style', SizeVan::class)
            ->setController(SizeVanCrudController::class),
            MenuItem::linkToCrud('Types', 'fas fa-shuttle-van', TypeVan::class)
            ->setController(TypeVanCrudController::class),
            MenuItem::linkToCrud('Années', 'fas fa-sort-numeric-up-alt', YearVan::class)
            ->setController(YearVanCrudController::class),
            MenuItem::linkToCrud('Kilométrage', 'fas fa-road', KilometerVan::class)
            ->setController(KilometerVanCrudController::class),
            MenuItem::linkToCrud('Placage', 'fas fa-shuttle-van', Veneer::class)
            ->setController(VeneerCrudController::class),
            MenuItem::linkToCrud('Isolation', 'fas fa-border-all', Insulation::class)
            ->setController(InsulationCrudController::class),
            MenuItem::linkToCrud('Sol', 'fas fa-pallet', Floor::class)
            ->setController(FloorCrudController::class),
            MenuItem::linkToCrud('Ameublements', 'fas fa-couch', VanFurnishing::class)
            ->setController(VanFurnishingCrudController::class),
            MenuItem::linkToCrud('Régions', 'fas fa-map-pin', Region::class)
            ->setController(RegionCrudController::class),
            MenuItem::linkToCrud('Spécialités', 'fas fa-plus-circle', SpecialtiesVanArtisan::class)
            ->setController(SpecialtiesVanArtisanCrudController::class),
            MenuItem::linkToCrud('Aménagement général', 'fas fa-wrench', GeneralSetup::class)
            ->setController(GeneralSetupCrudController::class),
            MenuItem::linkToCrud('Types d\'aménagement', 'fas fa-ruler-combined', SpecificSetup::class)
            ->setController(SpecificSetupCrudController::class),
        ]);
        
    }
}
