<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('libelle')
            // ->add('description')
            // ->add('dateDebut')
            // ->add('dateFin')
        ->add('description', TextareaType::class)
            ->add('libelle')
          
            ->add('dateDebut', DateType::class, [
                'label' => "Date de création",
                'html5' => false,
                'attr' => ['class' => 'no-auto skip-init'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])


            ->add('dateFin', DateType::class, [
                'label' => "Date fin",
                'html5' => false,
                'attr' => ['class' => 'no-auto skip-init'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])
            

            ->add('documentAteliers', CollectionType::class, [
                'entry_type' => DocumentAtelierType::class,
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
            'data_class' => Atelier::class,
            'doc_required' => true,
            'doc_options' => [],
            'validation_groups' => [],
        ]);
        $resolver->setRequired('doc_options');
        $resolver->setRequired('doc_required');
        $resolver->setRequired(['validation_groups']);
    }
}
