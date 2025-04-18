<?php

namespace App\Form;

use App\Entity\Bailleur;
use App\Entity\Element;
use App\Entity\Employe;
use App\Entity\LigneMission;
use App\Entity\Mission;
use App\Entity\MoyenTransport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $etat = $options['etat'];
     
        $builder
            // ->add('objetMission')
            // ->add('numeroOM')
            // ->add('dateCreationMission')
            // ->add('dateDebutPrevue')
            // ->add('dateFinPrevue')
            // ->add('dateDebutEffective')
            // ->add('dateFinEffective')
            // ->add('montantParticipantMission')
            // ->add('pourcentageAvanceMission')
            // ->add('initiateurMission')
            // ->add('imputationBudgetaire')
            // ->add('options')
            // ->add('employe')
            // ->add('moyenTransport')
            // ->add('participants')
            // ->add('compteRendu')
            // ->add('fichier')

            ->add('objetMission', null, ['label' => 'Objet de la mission']) 
    
        ->add('dateDebutPrevue',
         DateType::class, [
            'label' => 'Date de debut',
            'html5' => false,
            'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'empty_data' => date('d/m/Y')
        ])

        ->add(
            'dateFinPrevue',
            TextType::class, ['label' => 'Date de fin',
                'attr' => ['readonly' => true],
            ]
        )
       
     
        
            ->add('moyenTransport', EntityType::class, ['class' => MoyenTransport::class, 'choice_label' => 'libelle', 'label' => 'Moyen de transport'])
            ->add('options', ChoiceType::class, [
                'multiple' => true,
                'choices' => array_flip(Mission::OPTIONS),
                'expanded' => true,

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
                'multiple'      => true,
            ]
        )
            ->add('compteRendu')
      
        ->add('fichier', FichierType::class, ['label' => 'JOINDRE LES TDR', 'label' => false, 'doc_options' => $options['doc_options'], 'required' => $options['doc_required'] ?? true])
        ->add('ligneMissions', CollectionType::class, [
            'entry_type' => LigneMissionType::class,
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

        $builder->get('dateFinPrevue')->addModelTransformer(new CallbackTransformer(
            function ($data) {
                return $data ? $data->format('d/m/Y') : $data;
            },
            function ($data) {
                return new \DateTime(str_replace('/', '-', $data));
            }
        ));

        

        if($etat == "create"){
            $builder->add('justification', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ]);
      
          }

        if ($etat == "en_cours") {
            $builder->add('justification', TextareaType::class, [
                'label' => 'Commentaire',
                "required" => false,
                'attr' => ['readonly' => false, ]
            ])
            ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider btn-sm ']]);
        }


        // if ($etat == 'en_cours') {
        //     $builder->add('justification', TextareaType::class, [
        //         'label' => 'La raison du rejet du rapport',
        //         'attr' => ['readonly' => true]
        //     ])
        //         // ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible ']])
        //         ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider  ']]);
        // }


        // if ($etat == 'en_cours') {
        //     $builder->add('justification', TextareaType::class, [
        //         'label' => ' ',
        //         "required" => false,
        //         'attr' => ['readonly' => true, 'hidden' => true]
        //     ])
        //         ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']])
        //         ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']]);
        // }



        // if ($etat == 'en_cours') {
        //     $builder->add('justification', HiddenType::class, [
        //         'label' => 'la cause du rejet du rapport',
        //         "required" => false,
        //         'attr' => ['readonly' => false]
        //     ])
        //         ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']]);
        //     // ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter ']]);
        // }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
            'doc_required' => true,
            'fichiers' => false,
            'doc_options' => [],
            'validation_groups' => [],
        ]);
        $resolver->setRequired('doc_options');
        $resolver->setRequired('doc_required');
        $resolver->setRequired(['validation_groups']);
        $resolver->setRequired('etat');

    }
}
