<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Quote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuoteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('character')
            ->add('quote')
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a movie'
            ])
            ->add('Save_Quote', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class', Quote::class]);
    }
}