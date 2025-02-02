<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Reunion;
use App\Entity\Salle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReunionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('libReunion')
            // ->add('dateReunion')
            // ->add('heureDebut')
            // ->add('heureFin')
            // ->add('salle')
            // ->add('points')
            // ->add('president')
            ->add('libReunion',TextType::class, ['label' => 'Objet*'])
            ->add('president', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function ($employe) {
                    return $employe->getNomComplet();
                },
                'label' => 'Président de la séance',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
        ->add('dateReunion', DateType::class, [
            'label' => 'Date ',
            'html5' => false,
            'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'empty_data' => date('d/m/Y')
        ])

        ->add('heureDebut', TimeType::class, [
            'widget' => 'single_text',
            'attr' => ['class' => 'timepicker'],
            'label' => 'Heure de début'
        ])
            ->add('heureFin', TimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'timepicker'],
                'label' => 'Heure de fin'
            ])
            ->add('salle', EntityType::class, [
                'class' => Salle::class,
                'choice_label' => 'libelle',
                'label' => 'Salle de réunion',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
          

            ->add(
                'participants',
                EntityType::class,
                [
                    'class'         => Employe::class,
                    'label'         => 'Participants',
                    'choice_label'  => function ($employe) {
                        return $employe->getNomComplet();
                    },
                    'required'      => true,
                'multiple' => true,
                'attr' => ['class' => 'has-select2 form-select']
                ]
            )

          

          

            ->add('points', CollectionType::class, [
                'entry_type' => OrdreJourType::class,
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
            'data_class' => Reunion::class,
        ]);
    }
}
