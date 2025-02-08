<?php

namespace App\Form;

use App\Entity\Dossier;
use App\Entity\Workflow;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etat = $options['etat'];
        $builder
            // ->add('libelle')
            // ->add('dateCreation')
            // ->add('description')
            // ->add('workfow')
          
        ->add('workfow', EntityType::class, [
            'class' => Workflow::class,
            'choice_label' => function ( $workflow) {
                return $workflow->getLibelle();
            },
            'label' => 'Workflow',
            'attr' => ['class' => 'has-select2 form-select']
        ])
        ->add('libelle', TextType::class, ['label' => 'Libellé'])

        ->add('dateCreation', DateType::class, [
            'label' => 'Date de creation',
            'html5' => false,
            'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'empty_data' => date('d/m/Y')
        ])
        ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false, 'empty_data' => ''])
        ->add('ligneReponsableDossier', CollectionType::class, [
            'entry_type' => LigneReponsableDossierType::class,
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

        if ($etat == "create") {
            $builder->add('justification', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ]);
        }

        if ($etat == "en_cours") {
            $builder
                ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider btn-sm ']]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);

        $resolver->setRequired('etat');

    }
}
