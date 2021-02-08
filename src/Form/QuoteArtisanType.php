<?php

namespace App\Form;

use App\Entity\BrandVan;
use App\Entity\Floor;
use App\Entity\GeneralSetup;
use App\Entity\KilometerVan;
use App\Entity\QuoteArtisan;
use App\Entity\SizeVan;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\SpecificSetup;
use App\Entity\TypeVan;
use App\Entity\YearVan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class QuoteArtisanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom *'
                    ]
            ])
            ->add('projectDate', DateType::class, [
                'widget' => 'choice',
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Date du projet *'
                    ]
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de téléphone'
                    ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom *'
                    ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Email *'
                    ]
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Message',
                    'rows' => '7'
                    ]
            ])
            ->add('address', TextareaType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse',
                    'rows' => '2'
                    ]
            ])
            ->add('generalSetup', EntityType::class, [
                'class' => GeneralSetup::class,
                'choice_label' => 'type',
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'by_reference' => false
            ])
            ->add('specificSetup', EntityType::class, [
                'class' => SpecificSetup::class,
                'choice_label' => 'type',
                'label' => false,
                'expanded' => false,
                'multiple' => false,
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
            ->add('floor', EntityType::class, [
                'class' => Floor::class,
                'choice_label' => 'type',
                'expanded' => false,
                'multiple' => false,
                'by_reference' => true,
                'label' => false,
            ])
            ->add('typeVan', EntityType::class, [
                'class' => TypeVan::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('sizeVan', EntityType::class, [
                'class' => SizeVan::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('brandVan', EntityType::class, [
                'class' => BrandVan::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('yearVan', EntityType::class, [
                'class' => YearVan::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('kilometerVan', EntityType::class, [
                'class' => KilometerVan::class,
                'choice_label' => 'name',
                'label' => false,
                'expanded' => false,
                'required' => true,
                'multiple' => false,
                'by_reference' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuoteArtisan::class,
        ]);
    }
}