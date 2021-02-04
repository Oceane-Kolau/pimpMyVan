<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\VanliferType;
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
}
