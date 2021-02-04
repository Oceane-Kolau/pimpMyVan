<?php

namespace App\Controller;

use App\Data\SearchArtisansData;
use App\Entity\User;
use App\Form\SearchArtisansType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository): Response
    {
        $lastArtisans = $userRepository->artisansHome();
        return $this->render('home/index.html.twig', [
            "lastArtisans" => $lastArtisans
        ]);
    }

    /**
     * @Route("/contact", name="home_contact")
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/amenageurs-van", name="home_allArtisans")
     */
    public function allArtisans(UserRepository $userRepository, Request $request): Response 
    {
        $search = new SearchArtisansData();
        $searchForm = $this->createForm(SearchArtisansType::class, $search);
        $searchForm->handleRequest($request);
        $allArtisans = $userRepository->searchArtisans($search);

        return $this->render('home/allArtisans.html.twig', [
            'artisans' => $allArtisans,
            'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/amenageurs/{slug}", name="home_artisan_show")
     */
    public function showArtisan(User $user): Response
    {
        return $this->render('home/show_artisan.html.twig', [
            'artisan' => $user
        ]);
    }
}
