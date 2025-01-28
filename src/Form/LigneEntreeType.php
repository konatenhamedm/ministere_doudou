<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\LigneEntree;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneEntreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('article', EntityType::class, [
                'class' => Article::class,
                'choice_label' => function ($data) {
                    return $data->getLibelle();
                },

                'label' => false,
                'required' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneEntree::class,
        ]);
    }
}
