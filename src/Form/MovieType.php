<?php

namespace App\Form;

use App\Entity\Movie;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Translation\Translator;

class MovieType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $translator = new Translator('');

        $builder
            ->add('name', TextType::class, [
                'label' => $translator->trans('Name'),
                'required' => true,
            ])
            ->add('releaseYear', NumberType::class, [
                'label' => $translator->trans('Release Year'),
                'required' => true,
            ])
            ->add('Save_Movie', SubmitType::class,[
                'label' => $translator->trans('Save Movie'),
            ]);
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class', Movie::class]);
    }
}