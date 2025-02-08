<?php

namespace App\Form;

use App\Entity\LigneMission;
use App\Entity\Village;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class LigneMissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('detailsLocalite')
            // ->add('dateDebut')
            // ->add('dateFin')
            // ->add('dateDebutEffectiveLocalite')
            // ->add('dateFinEffectiveLocalite')
            // ->add('mission')


            
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de debut ',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin ',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])


         
            // ->add('dateDebutEffectiveLocalite'
            //     , DateType::class
            //     , [
            //         "widget" => "single_text"
            //         , 'label' => 'Date de début effective'
            //         , 'format' => 'dd/MM/yyyy'
            //         , 'attr' => ['autocomplete' => 'off', 'class' => 'datepicker'],
            //     ])
            ->add('nbreJours', IntegerType::class, [
                'mapped' => false
                , 'attr' => ['step' => 1, 'min' => 1, 'class' => 'nbre-jours-table']
                , 'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez préciser le nombre de jour pour chaque ligne']),
                    new Assert\GreaterThanOrEqual([
                        'value' => 1
                        , 'message' => 'Le nombre de jour doit être >= {{ compared_value }} pour chaque ligne'
                    ])
                ]
            ])
            // ->add('dateFinEffectiveLocalite'
            //     , DateType::class
            //     , [
            //         "widget" => "single_text"
            //         , 'label' => 'Date de fin effective'
            //         , 'format' => 'dd/MM/yyyy'
            //         , 'attr' => ['autocomplete' => 'off', 'class' => 'datepicker date-fin-localite'],
            //     ])
            ->add(
            'village'
            , EntityType::class
                , [
                    'class' => Village::class
                    , 'choice_label' => 'libelle'
                    , 'placeholder' => '---Choisir une localité---',
                    'attr' => ['class' => 'has-select2 form-select']
                    , 'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('a')->orderBy('a.libelle', 'ASC');
                                        
                    }
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneMission::class,
        ]);
    }
}
