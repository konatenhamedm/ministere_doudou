<?php

namespace App\Form;

use App\Entity\Assurance;
use App\Entity\Vehicule;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('numeroPolice')
            // ->add('compagnie')
            // ->add('dateDebut')
            // ->add('dateFin')
            // ->add('montant')
            // ->add('vehicule') 
              ->add('numeroPolice',TextType::class, ['label' => 'N° Police'])
            ->add('compagnie',IntegerType::class, ['label' => 'Compagnie'])
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début ',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])
            ->add('montant',IntegerType::class, ['label' => 'Montant'])

        ->add('vehicule', EntityType::class, [
            'class' => Vehicule::class,
            'choice_label' => function ($data) {
                return $data->getImmatriculation();
            },

            'label' => 'Vehicule',
            'required' => false,
            'attr' => ['class' => 'has-select2 form-select']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Assurance::class,
        ]);
    }
}
