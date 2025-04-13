<?php

namespace App\Form;

use App\Entity\Affectation;
use App\Entity\Employe;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('dateDebut')
            // ->add('dateFin')
            // ->add('nature')
            // ->add('Affectation')
            // ->add('employe')

    
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function ($data) {
                    return $data->getImmatriculation();
                },

                'label' => 'Vehicule',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])


            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function ($data) {
                    return $data->getNomComplet();
                },

                'label' => 'Conducteur :*',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
       
 
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
      
            ->add('nature', TextareaType::class, [
                'label' => 'Nature de l\'affectation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Affectation::class,
        ]);
    }
}
