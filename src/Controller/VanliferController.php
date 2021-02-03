<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VanliferController extends AbstractController
{
    /**
     * @Route("/vanlifer", name="app_vanlifer_profile")
     */
    public function index(): Response
    {
        return $this->render('vanlifer/index.html.twig', [
            'controller_name' => 'VanliferController',
        ]);
    }
}
