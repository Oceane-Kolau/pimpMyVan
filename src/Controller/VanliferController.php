<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\QuoteArtisan;
use App\Entity\User;
use App\Form\VanliferType;
use App\Repository\ContactRepository;
use App\Repository\QuoteArtisanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route(name="vanlifer")
 * @IsGranted("ROLE_VANLIFER")
 * @Security("user.getIsValidated() === true")
 */
class VanliferController extends AbstractController
{
    /**
     * @Route("/vanlifer-profil", methods={"GET"}, name="_profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('vanlifer/index.html.twig', [
            'vanlifer' => $user,
        ]);
    }

    /**
     * @Route("/vanlifer-profil/edit/{id}", name="_edit", methods={"GET","POST"})
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
     * @Route("/vanlifer-profil/messagerie", methods={"GET"}, name="_messagerie")
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
     * @Route("/vanlifer-profil/messagerie/{id}", methods={"GET"}, name="_messagerie_show")
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
     * @Route("/vanlifer-profil/devis", methods={"GET"}, name="_quote")
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
     * @Route("/vanlifer-profil/devis/{id}", methods={"GET"}, name="_quote_show")
     */
    public function quoteShow(QuoteArtisan $quoteArtisan): Response
    {
        $user = $this->getUser();
        
        return $this->render('quote_artisan.html.twig', [
            'quote' => $quoteArtisan,
            'vanlifer' => $user,
        ]);
    }
}
