<?php

namespace App\Form;

use App\Entity\Sens;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            // ->add('sens', EntityType::class, [
            //     'class' => Sens::class,
            //     'choice_label' => 'libelle',
            //     'label' => 'Sens',
            //     'attr' =>
            //     ['class' => 'has-select2 form-select']
            // ])
            ->add('lignesorties', CollectionType::class, [
                'entry_type' => LigneSortieType::class,
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
            'data_class' => Sortie::class,
        ]);
    }
}
