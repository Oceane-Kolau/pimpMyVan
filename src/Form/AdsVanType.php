<?php

namespace App\Form;

use App\Entity\AdsVan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdsVanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('typeVan')
            ->add('sizeVan')
            ->add('brandVan')
            ->add('yearVan')
            ->add('kilometerVan')
            ->add('specificSetup')
            ->add('generalSetup')
            ->add('floor')
            ->add('specialtiesVan')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdsVan::class,
        ]);
    }
}
