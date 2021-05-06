<?php

namespace App\Controller;

use App\Data\SearchArtisansData;
use App\Entity\AdsVan;
use Knp\Snappy\Pdf;
use Twig\Environment;
use App\Entity\Contact;
use App\Entity\QuoteArtisan;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\QuoteArtisanType;
use App\Form\SearchArtisansType;
use App\Repository\AdsVanRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\MailerService;
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
     * @Route("/contact", name="home_contact", methods={"GET", "POST"})
     */
    public function contact(Request $request, MailerService $mailerService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $mailerService->sendEmailAfterContact($contact);
            return $this->render('home/confirmation_message.html.twig');
        }
        return $this->render('home/contact.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
        ]);
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

        return $this->render('home/artisanSection/allArtisans.html.twig', [
            'artisans' => $allArtisans,
            'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/amenageurs/{slug}", name="home_artisan_show", methods={"GET", "POST"})
     */
    public function showArtisan(User $user, Request $request, MailerService $mailerService): Response
    {
        return $this->render('home/artisanSection/show_artisan.html.twig', [
            'artisan' => $user
        ]);
    }

    /**
     * @Route("/amenageurs/{slug}/demande-devis", name="home_artisan_quote", methods={"GET", "POST"})
     */
    public function devisArtisan(User $user, Request $request, MailerService $mailerService, Environment $twig, Pdf $pdf): Response
    {
        $quote = new QuoteArtisan();
        $form = $this->createForm(QuoteArtisanType::class, $quote);
        $form->handleRequest($request);
        $this->twig = $twig;
        $this->pdf = $pdf;

        if ($form->isSubmitted() && $form->isValid()) {
            $quote->setArtisan($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quote);
            $entityManager->flush();
            $html = $this->twig->render('quote_artisan.html.twig', ['quote' => $quote]);
            $pdf = $this->pdf->getOutputFromHtml($html);
            $mailerService->sendEmailAfterQuoteArtisan($quote, $pdf);
            return $this->render('home/confirmation_message.html.twig', ['quote' => $quote]);
        }
        return $this->render('home/artisanSection/quote_artisan.html.twig', [
            'artisan' => $user,
            'form' => $form->createView(),
            'quote' => $quote
        ]);
    }

    /**
     * @Route("/amenageurs/{slug}/contact", name="home_artisan_contact", methods={"GET", "POST"})
     */
    public function contactArtisan(User $user, Request $request, MailerService $mailerService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $mailerService->sendEmailAfterContactArtisan($contact);
            return $this->render('home/confirmation_message.html.twig');
        }
        return $this->render('home/artisanSection/contact_artisan.html.twig', [
            'artisan' => $user,
            'form' => $form->createView(),
            'contact' => $contact
        ]);
    }
    
    /** 
     * @Route("/annonces-van-occasion", name="home_adsVan", methods={"GET"})
    */
    public function adsVan(Request $request, AdsVanRepository $adsVanRepository) {
        $adsVans = $adsVanRepository->findAll();

        return $this->render('home/adsVanSection/adsVan.html.twig', [
            'adsVans' => $adsVans
        ]);
        
    }

    /** 
     * @Route("/annonces-van-occasion/{slug}", name="home_adsVan_show", methods={"GET"})
    */
    public function adsVanShow(Request $request, AdsVan $adsVan) {
        
        return $this->render('home/adsVanSection/adsVan_show.html.twig', [
            'adsVan' => $adsVan
        ]);
        
    }
}