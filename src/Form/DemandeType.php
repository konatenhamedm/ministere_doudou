<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etat = $options['etat'];
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


        // if ($etat == "create") {
        //     $builder->add('justification', HiddenType::class, [
        //         'label' => ' ',
        //         "required" => false,
        //         'attr' => ['readonly' => true, 'hidden' => true]
        //     ]);
        // }

        if ($etat == "en_cours") {
            $builder
                ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider btn-sm ']]);
        }

        if ($etat == "valider") {
            $builder
                ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider btn-sm ']]);
        }
          
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
        $resolver->setRequired('etat');
    }
}
