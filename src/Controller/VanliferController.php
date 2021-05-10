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
use App\Service\SlugifyService;
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
        return $this->render('profile/index.html.twig', [
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

            return $this->redirectToRoute('vanlifer_profile',
            [
                'slug' => $user->getSlug(),
            ]);
        }

        return $this->render('profile/vanlifer/edit.html.twig', [
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

        return $this->render('profile/message/messagerie.html.twig', [
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
        
        return $this->render('profile/message/show_messagerie.html.twig', [
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

        return $this->render('profile/quote/allQuotes.html.twig', [
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
     * @Route("annonces", name="_adsVan_index", methods={"GET"})
     */
    public function allAds(AdsVanRepository $adsVanRepository): Response
    {
        $user = $this->getUser();
        return $this->render('profile/adsVan/index.html.twig', [
            'adsVans' => $adsVanRepository->findBy(['user' => $user]),
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("new/annonce", name="_adsVan_new", methods={"GET","POST"})
     */
    public function newAds(Request $request, SlugifyService $slugifyService): Response
    {
        $user = $this->getUser();
        $adsVan = new AdsVan();
        $form = $this->createForm(AdsVanType::class, $adsVan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugifyService->generate($adsVan->getTitle().'-'.$user->getId());
            $adsVan->setSlug($slug);
            $adsVan->setIsValidated(false);
            $adsVan->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adsVan);
            $entityManager->flush();

            return $this->redirectToRoute('vanlifer_adsVan_index',
            [
                'slug' => $user->getSlug(),
            ]);
        }

        return $this->render('profile/adsVan/new.html.twig', [
            'adsVan' => $adsVan,
            'form' => $form->createView(),
            'vanlifer' => $user
        ]);
    }

    /**
     * @Route("annonce/{id}", name="_adsVan_show", methods={"GET"}), requirements={"id"="\d+"})
     */
    public function showAds(AdsVanRepository $adsVanRepository): Response
    {
        $user = $this->getUser();
        return $this->render('profile/adsVan/show.html.twig', [
            'adsVan' => $adsVanRepository->findBy(['user' => $user])[0],
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("annonce/edit/{id}", name="_adsVan_edit", methods={"GET","POST"}), requirements={"id"="\d+"})
     */
    public function editAds(Request $request, AdsVanRepository $adsVanRepository, AdsVan $adsVan): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AdsVanType::class, $adsVan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vanlifer_adsVan_index',
            [
                'slug' => $user->getSlug(),
            ]);
        }

        return $this->render('profile/adsVan/edit.html.twig', [
            'adsVan' => $adsVanRepository->findBy(['user' => $user])[0],
            'form' => $form->createView(),
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("annonce/{id}/delete", name="_adsVan_delete", methods={"DELETE"}), requirements={"id"="\d+"})
     * @ParamConverter("adsVan", class="App\Entity\AdsVan", options={"mapping": {"id" = "id"}})
     */
    public function deleteAds(Request $request, AdsVan $adsVan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adsVan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adsVan);
            $entityManager->flush();
        }
        $user = $this->getUser();

        return $this->redirectToRoute('vanlifer_adsVan_index',
        [
            'slug' => $user->getSlug(),
        ]);
    }
}