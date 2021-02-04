<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\GeneralSetup;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\SpecificSetup;
use App\Entity\Town;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ArtisanType extends AbstractType
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
            ->add('companyName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de mon entreprise'
                    ]
            ])
            // ->add('town', EntityType::class, [
            //     'class' => Town::class,
            //     'choice_label' => 'name',
            //     'label' => false,
            //     'expanded' => false,
            //     'required' => true,
            //     'multiple' => false,
            //     'by_reference' => false,
            // ])
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
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'by_reference' => false
            ])
            ->add('specificSetup', EntityType::class, [
                'class' => SpecificSetup::class,
                'choice_label' => 'type',
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
            ->add('profilePictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => false,
                'download_uri' => false,
                'label' => "Ajouter une photo de profil",
            ])
            ->add('pictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => false,
                'download_uri' => false,
                'label' => "Ajouter une photo d'un van ou d'un projet",
            ])
            ->add('bannerFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => false,
                'download_uri' => false,
                'label' => "Ajouter une photo d'un van ou d'un projet",
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
