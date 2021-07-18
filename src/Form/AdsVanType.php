<?php

namespace App\Form;

use App\Entity\AdsVan;
use App\Entity\Insulation;
use App\Entity\SpecialtiesVanArtisan;
use App\Entity\VanFurnishing;
use App\Entity\Veneer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AdsVanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('title')
            ->add('typeVan')
            ->add('sizeVan')
            ->add('brandVan')
            ->add('yearVan')
            ->add('kilometerVan')
            ->add('specificSetup')
            ->add('generalSetup')
            ->add('floor')
            ->add('pictureVanFile', VichFileType::class, [
                'required'      => true,
                'allow_delete'  => false,
                'download_uri' => false,
                'label' => "Ajouter une photo de votre van",
            ])
            ->add('specialtiesVan', EntityType::class, [
                'class' => SpecialtiesVanArtisan::class,
                'choice_label' => 'type',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => true,
                'label' => false,
            ])
            ->add('veneer', EntityType::class, [
                'class' => Veneer::class,
                'choice_label' => 'type',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => true,
                'label' => false,
            ])
            ->add('vanFurnishing', EntityType::class, [
                'class' => VanFurnishing::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => true,
                'label' => false,
            ])
            ->add('insulation', EntityType::class, [
                'class' => Insulation::class,
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
            'data_class' => AdsVan::class,
        ]);
    }
}