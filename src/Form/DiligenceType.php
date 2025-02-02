<?php

namespace App\Form;

use App\Entity\Diligence;
use App\Entity\OrdreJour;
use App\Entity\Reunion;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiligenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etat = $options['etat'];
        $builder
            // ->add('dateTraitementDiligence')

            // ->add('commentaireDiligence')
       
            ->add('dateTraitementDiligence', DateType::class, [
            'label' => 'Date de  traitement Diligence',
                'html5' => false,
                'attr' => ['class' => 'has-datepicker no-auto skip-init', 'autocomplete' => 'off'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'empty_data' => date('d/m/Y')
            ])


            ->add('commentaireDiligence')

            
     
            ->add(
            'points',EntityType::class,
                [
                    'class' => OrdreJour::class,
                    'choice_label' => function ($data) {
                        return $data->getnumOrdreJour();
                    },
                'label' => 'Ordre du jour',
                'attr' => ['class' => 'has-select2 form-select']

                ]);

        if ($etat == "en_cours") {
            $builder
                ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider btn-sm ']]);
        }
          
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diligence::class,
        ]);
        $resolver->setRequired('etat');
    }
}
