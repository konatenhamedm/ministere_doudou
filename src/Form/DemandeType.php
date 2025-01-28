<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('libelle')
            
            // ->add('dateValidation',DateType::class, [
            // 'label' => "Date de validation",
            // 'html5' => false,
            // 'attr' => ['class' => 'no-auto skip-init'],
            // 'widget' => 'single_text',
            // 'format' => 'dd/MM/yyyy',
            // 'empty_data' => date('d/m/Y')
                
            // ])
            // ->add('dateLivraison',DateType::class, [
            //     'label' => "Date de livraison",
            //     'html5' => false,
            //     'attr' => ['class' => 'no-auto skip-init'],
            //     'widget' => 'single_text',
            //     'format' => 'dd/MM/yyyy',
            //     'empty_data' => date('d/m/Y')
            // ])
        ->add('ligneDemandes', CollectionType::class, [
            'entry_type' => LigneDemandeType::class,
            'entry_options' => [
                'label' => false
            ],
            'allow_add' => true,
            'label' => false,
            'by_reference' => false,
            'allow_delete' => true,
            'prototype' => true,

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
