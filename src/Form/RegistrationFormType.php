<?php

namespace App\Form;

use App\Entity\GeneralSetup;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\SpecificSetup;
use App\Entity\Region;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Email *'
                    ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options'  => [
                    'attr' => ['placeholder' => 'Mot de passe *'],
                    'label' => false,
                ],
                'second_options'  => [
                    'attr' => ['placeholder' => 'Confirmation mot de passe *'],
                    'label' => false,
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom *'
                    ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom *'
                    ]
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('town', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('companyName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de mon entreprise'
                    ]
            ])
            ->add('acceptQuote', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'choices' => [
                    'J\'accepte' => true,
                    'Non, je n\'accepte que le formulaire de contact' => false
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => "J'accepte les CDG",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions d\'utilisation !',
                    ]),
                ],
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('facebookLink', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Compte Facebook'
                    ]
            ])
            ->add('instagramLink', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Compte Instagram'
                    ]
            ])
            ->add('websiteLink', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Site web'
                    ]
            ])
            ->add('generalSetup', EntityType::class, [
                'class' => GeneralSetup::class,
                'choice_label' => 'type',
                'label' => false,
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'by_reference' => false
            ])
            ->add('specificSetup', EntityType::class, [
                'class' => SpecificSetup::class,
                'choice_label' => 'type',
                'label' => false,
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'by_reference' => false
            ])
            ->add('specialtiesVanArtisan', EntityType::class, [
                'class' => SpecialtiesVanArtisan::class,
                'choice_label' => 'type',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => true,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
