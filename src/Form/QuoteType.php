<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Quote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Translation\Translator;

class QuoteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $translator = new Translator('');

        $builder
            ->add('character', TextType::class, [
                'label' => $translator->trans('Character'),
                'required' => true,
            ])
            ->add('quote', TextareaType::class, [
                'label' => $translator->trans('Quote'),
                'required' => true,
            ])
            ->add('movie', EntityType::class, [
                'label' => $translator->trans('Movie'),
                'class' => Movie::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('Save_Quote', SubmitType::class,[
                'label' => $translator->trans('Save Quote'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class', Quote::class]);
    }
}