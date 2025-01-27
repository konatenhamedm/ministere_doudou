<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\District;
use App\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('code')
            ->add('libelle')
            // ->add('abrege')
            // ->add('district')
            // ->add('chefLieu')
        ->add('chefLieu', EntityType::class, [
            'class' => Departement::class,
            'choice_label' => 'libelle',
            'label' => 'chefLieu',
            'required' => false,
            'attr' => ['class' => 'has-select2 form-select']
        ])
        ->add('district', EntityType::class, [
            'class' => District::class,
            'choice_label' => 'libelle',
            'label' => 'District',
            'attr' => ['class' => 'has-select2 form-select']
        ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
