<?php

namespace App\Form;

use App\Entity\Achat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('dateAchat')
        // ->add('piece')
        // ->add('fournisseur')
        // ->add('intervention')
         
            ->add('dateAchat', DateType::class, [
                'label' => 'Date d\'achat',
                    'html5' => false,
                    'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'empty_data' => date('d/m/Y')
                ])
            
            ->add('piece')
            ->add('fournisseur')
            ->add('intervention')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
