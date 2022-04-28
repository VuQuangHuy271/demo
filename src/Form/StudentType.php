<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, 
            [
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Enter Your Name',
                ],
                'required' => true,
            ])
                
                ->add('Gender', TextType::class,[
                    'label'=> 'Gender',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Enter your Gender',
                    ],

                ])
                ->add('DateOfBirth', DateType::class,
                [

                    'required' => true,
                    'widget' => 'single_text'
                ])
                ->add('Phone', TextType::class,
                [
                    'label' => 'Phone Student',
                    'required' => true,
                ])
                ->add('Email', TextType::class,
                [
                    'label' => 'Email',
                    'required' => true,
                ])

                ->add('Course', EntityType::class,
                [
                    'label' => 'Course name',
                    'class' => Course::class,
                    'required' => true,
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                ])
                ->add('Image', TextType::class,
                [
                    'label' => 'Image',
                    'required' => true,
                ])
                ->add('save', SubmitType::class)
                ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
