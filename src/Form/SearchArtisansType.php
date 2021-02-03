<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Data\SearchArtisansData;
use App\Entity\GeneralSetup;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\SpecificSetup;
use App\Entity\Town;

class SearchArtisansType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Recherche rapide'
                    ]
            ])

            ->add('specificSetup', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => SpecificSetup::class,
                'expanded' => true,
                'multiple' => true
            ])

            ->add('town', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Town::class,
                'expanded' => true,
                'multiple' => true
            ])

            ->add('specialtiesVanArtisan', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => SpecialtiesVanArtisan::class,
                'expanded' => true,
                'multiple' => true
            ])

            ->add('generalSetup', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => GeneralSetup::class,
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchArtisansData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}