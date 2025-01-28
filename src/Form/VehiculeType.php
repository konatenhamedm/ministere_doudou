<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Type;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('immatriculation')
            // ->add('chassi')
            // ->add('dateAcquisition')
            // ->add('dateMiseEnCirculation')
            // ->add('dateSortie')
            // ->add('actif')
            // ->add('marque')
            // ->add('modele')
            // ->add('type')
            ->add('immatriculation', TextType::class, ['label' => 'Immatriculation'])
            ->add('chassi', TextType::class, ['label' => 'Chassis'])
            ->add(
                'dateAcquisition',
                DateType::class,
                [
                'widget' => 'single_text',
                'html5' => false, // Désactiver le champ HTML5
                'label' => 'Date  Acquisition',
                'format' => 'dd/MM/yyyy', // Personnalisation du format
                'empty_data' => date('d/m/Y'),
                'attr' => ['autocomplete' => 'off', 'class' => 'date-fin-localite'],
                ]
            )
            ->add(
                'dateMiseEnCirculation',
                DateType::class,
                [
                'widget' => 'single_text',
                'html5' => false, // Désactiver le champ HTML5
                'label' => 'Date  Mise En Circulation',
                'format' => 'dd/MM/yyyy', // Personnalisation du format
                'empty_data' => date('d/m/Y'),
                'attr' => ['autocomplete' => 'off', 'class' => 'date-fin-localite']
                ]
            )
            ->add(
                'dateSortie',
                DateType::class,
                [
                'widget' => 'single_text',
                'html5' => false, // Désactiver le champ HTML5
                'label' => 'Date  Sortie',
                'format' => 'dd/MM/yyyy', // Personnalisation du format
                'empty_data' => date('d/m/Y'),
                'attr' => ['autocomplete' => 'off', 'class' => 'date-fin-localite']
                ]
            )

            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => function ($data) {
                    return $data->getLibelle();
                },

                'label' => 'Marque',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => function ($data) {
                    return $data->getLibelle();
                },

                'label' => 'Modèle',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])

            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => function ($data) {
                    return $data->getLibelle();
                },

                'label' => 'Type',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
            
        
         
            ->add('actif', null, ['label' => 'Actif'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
