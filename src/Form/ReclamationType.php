<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Contenu')
            ->add('Type', ChoiceType::class, [
                'choices'  => [
                    'produit' => "produit",
                    'panier' => "panier",
                    'actualité' => "actualité",
                    'other' => "other",
                ]])
            ->add('etat', ChoiceType::class, [
                'choices'  => [
                    'bien' => "bien",
                    'mauvais' => "mauvais",
                ]])
            ->add('image',FileType::class,array('data_class'=>null,'required' => false))
            ->add('submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1'
                ]

            ])
            ->add('annuler',ResetType::class,[
                'attr'=>[
                    'class'=>'nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
