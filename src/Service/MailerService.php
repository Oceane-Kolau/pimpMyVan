<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\Contact;
use App\Entity\QuoteArtisan;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailAfterContact(Contact $contact): void
    {
        $email = (new TemplatedEmail())
            ->from('kolau.oceane@gmail.com')
            ->to('kolau.oceane@gmail.com')
            ->subject('Nouveau message de Pimp My Van')
            ->html(
                '<p>' . $contact->getFirstname() . ' ' .
                $contact->getLastname() . '</p> vous a envoyé un message:</p>' .
                '<p>Pour lui répondre ' .
                '<p>Email : ' . $contact->getEmail() . ' ' .
                '<p>Sujet : ' . $contact->getSubject() . '</p>' .
                '<p>Message ' . $contact->getMessage() . '</p>'
            );

        $this->mailer->send($email);
    }

    public function sendEmailAfterContactArtisan(Contact $contact): void
    {
        $email = (new TemplatedEmail())
            ->from('kolau.oceane@gmail.com')
            ->to($contact->getUser()->getEmail())
            ->subject('Nouveau message de Pimp My Van')
            ->html(
                '<p>' . $contact->getFirstname() . ' ' . $contact->getLastname() . '</h4> vous a envoyé un message:</p>' .
                '<p>' . $contact->getEmail() . '</h4> pour lui répondre</p>' .
                '<p>Sujet: ' . $contact->getSubject() . '</p>' .
                '<p>' . $contact->getMessage() . '</p>'
            );

        $this->mailer->send($email);
    }

    public function sendEmailAfterQuoteArtisan(QuoteArtisan $quote, $pdf): void
    {
        $email = (new TemplatedEmail())
            ->from('kolau.oceane@gmail.com')
            ->to($quote->getArtisan()->getEmail())
            ->subject('Nouveau message de Pimp My Van')
            ->html(
                '<p>' . $quote->getFirstname() . ' ' . $quote->getLastname() . '</h4> vous a envoyé un message:</p>' .
                '<p>' . $quote->getEmail() . '</h4> pour lui répondre</p>' .
                '<p>' . $quote->getMessage() . '</p>'
            )
            ->context([
                ])
                ->attach($pdf, sprintf('demande-devis.pdf', date('Y-m-d')));

        $this->mailer->send($email);
    }
}