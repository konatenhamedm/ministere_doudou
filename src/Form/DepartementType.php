<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('code', null, ['label' => 'Code'])
            ->add('libelle', null, ['label' => 'Libellé'])
            // ->add('abrege', null, ['label' => 'Abbréviation'])
            ->add(
                'region',
                EntityType::class,
                [
                    'label' => 'Région',
                    'class' => Region::class,
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
            'data_class' => Departement::class,
        ]);
    }
}
