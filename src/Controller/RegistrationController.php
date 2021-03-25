<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppLoginAuthenticator;
use App\Service\SlugifyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register/artisan", name="app_register_artisan")
     */
    public function registerArtisan(
        Request $request,
        SlugifyService $slugifyService,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppLoginAuthenticator $authenticator
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_ARTISAN']);
            $user->setIsValidated(false);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            if ($form->get('acceptQuote')->getData(true)) {
                $user->setAcceptQuote(true);
            } else {
                $user->setAcceptQuote(false);
            }
            if (!empty($user->getCompanyName())) {
                $slug = $slugifyService->generate($user->getCompanyName());
                $user->setSlug($slug);
            } else {
                $slug = $slugifyService->generate($user->getFirstname().'-'.$user->getId());
                $user->setSlug($slug);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register_artisan.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/vanlifer", name="app_register_vanlifer")
     */
    public function registerVanlifer(
        Request $request,
        SlugifyService $slugifyService, 
        UserPasswordEncoderInterface $passwordEncoder, 
        GuardAuthenticatorHandler $guardHandler, 
        AppLoginAuthenticator $authenticator
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_VANLIFER']);
            $user->setIsValidated(true);
            $slug = $slugifyService->generate($user->getLastname().'-'.$user->getId());
            $user->setSlug($slug);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register_vanlifer.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
