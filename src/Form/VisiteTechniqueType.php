<?php

namespace App\Form;

use App\Entity\Vehicule;
use App\Entity\VisiteTechnique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteTechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('dateDerniereVisite')
            // ->add('dateProchaineVisite')
            // ->add('observation')
            // ->add('vehicule')
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function ($data) {
                    return $data->getImmatriculation();
                },

                'label' => 'Vehicule',
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
        ->add('dateDerniereVisite', DateType::class, [
            'widget' => 'single_text',
            'html5' => false, // Désactiver le champ HTML5
            'label' => 'Date Derniere Visitet',
            'format' => 'dd/MM/yyyy', // Personnalisation du format
            'empty_data' => date('d/m/Y'),
            'attr' => ['autocomplete' => 'off', 'class' => 'date-debut-localite'],])
        ->add('dateProchaineVisite', DateType::class, [
            'widget' => 'single_text',
            'html5' => false, // Désactiver le champ HTML5
            'label' => 'Date de Prochaine Visite',
            'format' => 'dd/MM/yyyy', // Personnalisation du format
            'empty_data' => date('d/m/Y'),
            'attr' => ['autocomplete' => 'off', 'class' => 'date-debut-localite'],
            ])
        ->add('observation', TextareaType::class, ['label' => 'Observation'])
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VisiteTechnique::class,
        ]);
    }
}
