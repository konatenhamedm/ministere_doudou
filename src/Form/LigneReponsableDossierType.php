<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\LigneEtape;
use App\Entity\LigneReponsableDossier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneReponsableDossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('LigneEtape', EntityType::class, [
                'label' => false,
                'class' => LigneEtape::class,
                'choice_label' => function (LigneEtape $d) {
                    return  $d->getLibelle();
                },
                'attr' => [
                    'class' => 'form-control has-select2',
                    'readonly' => true,
                ]
            ])
            ->add(
            'responsable',
                EntityType::class,
                [
                    'label' => 'Responsable',
                    'class' => Employe::class,
                    'choice_label' => function ($employe) {
                        return $employe->getNomComplet();
                    },
                ]
            )
            // ->add('responsable')
            // ->add('LigneEtape')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneReponsableDossier::class,
        ]);
    }
}
