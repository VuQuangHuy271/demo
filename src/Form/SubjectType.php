<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Subject Name',
                'required' => true,
                'attr'=>[
                    'maxlenght' => 5,
                    'minlenght' => 30
                ]

            ])
            // ->add('teacher')
            ->add('description', TextType::class,
            [
                'label' => 'Description',
                'required' => true,
                'attr'=>[
                    'maxlenght' => 5,
                    'minlenght' => 100
                ]

            ])
            ->add('image', TextType::class,
            [
                'label' => 'Subject Image',
                'required' => true
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
