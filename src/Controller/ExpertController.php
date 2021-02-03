<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route(name="expert")
 * @IsGranted("ROLE_EXPERT")
 */
class ExpertController extends AbstractController
{
    /**
     * @Route("/expert-profil", methods={"GET"}, name="_profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if ($user->getIsValidated() == false) {
            return $this->render('registration/moderation_expert.html.twig', [
                'user' => $user,
            ]);
        }

        return $this->render('expert/index.html.twig', [
            'controller_name' => 'ExpertController',
        ]);
    }
}
