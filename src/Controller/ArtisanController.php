<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ArtisanType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="artisan")
 * @IsGranted("ROLE_ARTISAN")
 */
class ArtisanController extends AbstractController
{
    /**
     * @Route("/artisan-profil", methods={"GET"}, name="_profile")
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
     * @Route("/artisan-profil/edit/{id}", name="_edit", methods={"GET","POST"})
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
}
