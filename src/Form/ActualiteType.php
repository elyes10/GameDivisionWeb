<?php

namespace App\Form;

use App\Entity\Actualite;
use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('image',FileType::class,array('data_class'=>null,'required' => false))
            ->add('submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary'
                ]

            ])
            ->add('annuler',ResetType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actualite::class,
        ]);
    }
}
