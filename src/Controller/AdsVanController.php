<?php

namespace App\Controller;

use App\Entity\AdsVan;
use App\Form\AdsVanType;
use App\Repository\AdsVanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ads/van")
 */
class AdsVanController extends AbstractController
{
    /**
     * @Route("/", name="ads_van_index", methods={"GET"})
     */
    public function allAds(AdsVanRepository $adsVanRepository): Response
    {
        return $this->render('ads_van/index.html.twig', [
            'ads_vans' => $adsVanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ads_van_new", methods={"GET","POST"})
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
     * @Route("/{id}", name="ads_van_show", methods={"GET"})
     */
    public function showAds(AdsVan $adsVan): Response
    {
        return $this->render('ads_van/show.html.twig', [
            'ads_van' => $adsVan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ads_van_edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="ads_van_delete", methods={"DELETE"})
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
