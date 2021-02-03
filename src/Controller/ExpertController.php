<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpertController extends AbstractController
{
    /**
     * @Route("/expert", name="app_expert_profile")
     */
    public function index(): Response
    {
        return $this->render('expert/index.html.twig', [
            'controller_name' => 'ExpertController',
        ]);
    }
}
