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
            'widget' => 'single_text',
            'html5' => false, // Désactiver le champ HTML5
            'label' => 'Date de début',
            'format' => 'dd/MM/yyyy', // Personnalisation du format
            'empty_data' => date('d/m/Y'),
            'attr' => ['autocomplete' => 'off', 'class' => 'date-debut-localite'],
        ])
        ->add('dateFin', DateType::class, [
            'widget' => 'single_text',
            'html5' => false, // Désactiver le champ HTML5
            'label' => 'Date de fin',
            'format' => 'dd/MM/yyyy', // Personnalisation du format
            'empty_data' => date('d/m/Y'),
            'attr' => ['autocomplete' => 'off', 'class' => 'date-fin-localite'],
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
