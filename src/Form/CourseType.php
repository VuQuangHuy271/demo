<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Enter Course Name',
                ],
                'required' => true,
            ])
            ->add('Description', TextType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('DateStart', DateType::class, [
                'required' => true,
                'widget' => 'single_text'
            ])

            ->add('DateEnd', DateType::class, [
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
