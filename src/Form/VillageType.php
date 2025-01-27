<?php

namespace App\Form;

use App\Entity\SousPrefecture;
use App\Entity\Village;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', null, ['label' => 'Libellé'])
            // ->add('code', null, ['label' => 'Code', 'empty_data' => null, 'required' => false])
            // ->add('abrege', null, ['label' => 'Abbréviation', 'empty_data' => null, 'required' => false])
            ->add('sousPrefecture',EntityType::class, ['class' => SousPrefecture::class, 'choice_label' => 'libelle', 'label' => 'Sous Prefecture', 'attr' => ['class' => 'has-select2 form-select']])

            ->add('sousPrefecture', EntityType::class, [
                'class' => SousPrefecture::class,
                'choice_label' => 'libelle',
                'label' => 'Sous Prefecture',
                'attr' => ['class' => 'has-select2 form-select']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Village::class,
        ]);
    }
}
