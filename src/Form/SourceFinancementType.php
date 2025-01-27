<?php

namespace App\Form;

use App\Entity\SourceFinancement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class SourceFinancementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('libelle', null, ['label' => 'Libellé'])
           ->add('pourcentage', IntegerType::class, ['label' => 'Pourcentage'])
           ->add('montant', IntegerType::class, ['label' => 'Montant'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SourceFinancement::class,
        ]);
    }
}
