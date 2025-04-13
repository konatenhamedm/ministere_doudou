<?php

namespace App\Form;

use App\Entity\Carburant;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarburantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('reference')
            // ->add('date')
            // ->add('quantite')
            // ->add('montant')
            // ->add('vehicule')
            ->add('reference', TextType::class, ['label' => 'Reference'])

            ->add('date', DateType::class, [
                'label' => 'Date de début',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])
            ->add('quantite', IntegerType::class, ['label' => 'Quantité'])
            ->add('montant', IntegerType::class, ['label' => 'Montant'])
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
            'data_class' => Carburant::class,
        ]);
    }
}
