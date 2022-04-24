<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SemesterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Semester',
                'required' => true,
                'attr'=>[
                    'maxlenght' => 5,
                    'minlenght' => 30
                ]

            ])
            ->add('dateStart', DateType::class, [
                'label'=>'Published date',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('dateEnd', DateType::class, [
                'label'=>'Published date',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
