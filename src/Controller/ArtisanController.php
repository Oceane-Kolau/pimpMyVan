<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\QuoteArtisan;
use App\Entity\User;
use App\Form\ArtisanType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("artisan/{slug}/", name="artisan")
 * @ParamConverter("user", class="App\Entity\User", options={"mapping": {"slug": "slug"}})
 * @IsGranted("ROLE_ARTISAN")
 */
class ArtisanController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="_profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_artisan.html.twig', [
                'user' => $user,
            ]);
        }

        return $this->render('artisan/index.html.twig', [
            'artisan' => $user,
        ]);
    }

    /**
     * @Route("edit/{id}", name="_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('expert/validation.html.twig', [
                'user' => $user,
            ]);
        }

        $form = $this->createForm(ArtisanType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('acceptQuote')->getData(true)) {
                $user->setAcceptQuote(true);
            } else {
                $user->setAcceptQuote(false);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('artisan_profile');
        }

        return $this->render('artisan/edit.html.twig', [
            'artisan' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("messagerie", methods={"GET"}, name="_messagerie")
     */
    public function contacts(): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_artisan.html.twig', [
                'user' => $user,
            ]);
        }

        $contacts = $user->getContacts();

        return $this->render('artisan/messagerie.html.twig', [
            'contacts' => $contacts,
            'artisan' => $user,
        ]);
    }

    /**
     * @Route("messagerie/{id}", methods={"GET"}, name="_messagerie_show")
     */
    public function contactShow(Contact $contact): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_artisan.html.twig', [
                'user' => $user,
            ]);
        }
        return $this->render('artisan/show_messagerie.html.twig', [
            'contact' => $contact,
            'artisan' => $user,
        ]);
    }

    /**
     * @Route("devis", methods={"GET"}, name="_quote")
     */
    public function quotes(): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_artisan.html.twig', [
                'user' => $user,
            ]);
        }

        $quotes = $user->getQuoteArtisans();

        return $this->render('artisan/allQuotes_artisan.html.twig', [
            'quotes' => $quotes,
            'artisan' => $user,
        ]);
    }

    /**
     * @Route("devis/{id}", methods={"GET"}, name="_quote_show")
     */
    public function quoteShow(QuoteArtisan $quoteArtisan): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_artisan.html.twig', [
                'user' => $user,
            ]);
        }

        return $this->render('quote_artisan.html.twig', [
            'quote' => $quoteArtisan,
            'artisan' => $user,
        ]);
    }
}
