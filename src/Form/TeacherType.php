<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Teacher;
use App\Entity\Specialized;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeacherType extends AbstractType
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
                
                ->add('Gender', ChoiceType::class,[
                    'choices'  => [
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Unknown' => 'Unknown'
                    ],

                ])
                ->add('DateOfBirth', DateType::class,
                [
                    'required' => true,
                    'widget' => 'single_text'
                ])
                ->add('Phone', TelType::class,
                [
                    'label' => 'Phone',
                    'required' => true,
                ])
                ->add('Email', EmailType::class,
                [
                    'label' => 'Email',
                    'required' => true,
                ])

                ->add('Status', ChoiceType::class,
                [
                    'choices'  => [
                        'is Active' => 'is Active',
                        'Quit job' => 'Quit job',
                    ],
                ])
                ->add('Image', TextType::class,
                [
                    'label' => 'Image',
                    'required' => true,
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Image']
                ])
                ->add('specialized', EntityType::class, [
                    'label' => 'Specialized Name',
                    'required' => true,
                    'class' => Specialized::class,
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false
                ])
                ->add('save', SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-primary']
                ])
                ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
