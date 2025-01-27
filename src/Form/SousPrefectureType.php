<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\SousPrefecture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousPrefectureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('libelle')
            // ->add('code')
            // ->add('abrege')
            // ->add('departement')

        // ->add('code', null, ['label' => 'Code'])
        ->add('libelle', null, ['label' => 'Libellé'])
        // ->add('abrege', null, ['label' => 'Abbréviation'])
        ->add(
            'departement',
            EntityType::class,
            [
                'label' => 'Région',
                'class' => Departement::class,
                'choice_label' => function ($data) {
                    return $data->getLibelle();
                },
            ]
        );
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousPrefecture::class,
        ]);
    }
}
