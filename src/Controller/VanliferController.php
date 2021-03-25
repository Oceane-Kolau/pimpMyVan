<?php

namespace App\Controller;

use App\Entity\AdsVan;
use App\Entity\Contact;
use App\Entity\QuoteArtisan;
use App\Entity\User;
use App\Form\AdsVanType;
use App\Form\VanliferType;
use App\Repository\AdsVanRepository;
use App\Repository\ContactRepository;
use App\Repository\QuoteArtisanRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("vanlifer/{slug}/", name="vanlifer")
 * @ParamConverter("user", class="App\Entity\User", options={"mapping": {"slug": "slug"}})
 * @IsGranted("ROLE_VANLIFER")
 * @Security("user.getIsValidated() === true")
 */
class VanliferController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="_profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('vanlifer/index.html.twig', [
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("edit/{id}", name="_edit", methods={"GET","POST"}), requirements={"id"="\d+"})
     */
    public function edit(Request $request, User $user): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(VanliferType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('vanlifer_profile');
        }

        return $this->render('vanlifer/edit.html.twig', [
            'vanlifer' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("messagerie", methods={"GET"}, name="_messagerie")
     */
    public function contacts(ContactRepository $contactRepository): Response
    {
        $user = $this->getUser();
        $email = $user->getEmail();

        $contacts = $contactRepository->findBy(['email' => $email]);

        return $this->render('vanlifer/messagerie.html.twig', [
            'contacts' => $contacts,
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("messagerie/{id}", methods={"GET"}, name="_messagerie_show"), requirements={"id"="\d+"})
     */
    public function contactShow(Contact $contact): Response
    {
        $user = $this->getUser();
        
        return $this->render('vanlifer/show_messagerie.html.twig', [
            'contact' => $contact,
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("devis", methods={"GET"}, name="_quote"), 
     */
    public function quotes(QuoteArtisanRepository $quoteArtisanRepository): Response
    {
        $user = $this->getUser();
        $email = $user->getEmail();

        $quotes = $quoteArtisanRepository->findBy(['email' => $email]);

        return $this->render('vanlifer/allQuotes_vanlifer.html.twig', [
            'quotes' => $quotes,
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("devis/{id}", methods={"GET"}, name="_quote_show"), requirements={"id"="\d+"})
     */
    public function quoteShow(QuoteArtisan $quoteArtisan): Response
    {
        $user = $this->getUser();
        
        return $this->render('quote_artisan.html.twig', [
            'quote' => $quoteArtisan,
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("annonces", name="ads_van_index", methods={"GET"})
     */
    public function allAds(AdsVanRepository $adsVanRepository): Response
    {
        return $this->render('ads_van/index.html.twig', [
            'ads_vans' => $adsVanRepository->findAll(),
        ]);
    }

    /**
     * @Route("nouvelle-annonce", name="ads_van_new", methods={"GET","POST"})
     */
    public function newAds(Request $request): Response
    {
        $adsVan = new AdsVan();
        $form = $this->createForm(AdsVanType::class, $adsVan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adsVan);
            $entityManager->flush();

            return $this->redirectToRoute('ads_van_index');
        }

        return $this->render('ads_van/new.html.twig', [
            'ads_van' => $adsVan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("annonce/{id}", name="ads_van_show", methods={"GET"}), requirements={"id"="\d+"})
     */
    public function showAds(AdsVan $adsVan): Response
    {
        return $this->render('ads_van/show.html.twig', [
            'ads_van' => $adsVan,
        ]);
    }

    /**
     * @Route("annonce/edit/{id}", name="ads_van_edit", methods={"GET","POST"}), requirements={"id"="\d+"})
     */
    public function editAds(Request $request, AdsVan $adsVan): Response
    {
        $form = $this->createForm(AdsVanType::class, $adsVan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ads_van_index');
        }

        return $this->render('ads_van/edit.html.twig', [
            'ads_van' => $adsVan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("annonce/supprimer/{id}", name="ads_van_delete", methods={"DELETE"}), requirements={"id"="\d+"})
     */
    public function deleteAds(Request $request, AdsVan $adsVan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adsVan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adsVan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ads_van_index');
    }
}
