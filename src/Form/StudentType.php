<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Specialized;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                ->add('specialized', EntityType::class, [
                    'label' => 'Specialized Name',
                    'required' => true,
                    'class' => Specialized::class,
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false
                //multiple = true: ManyToMany, OneToMany => có thể chọn nhiều item
                //multiple = false: OneToOne, ManyToOne => chỉ được chọn 1 item
                //expanded = true: hiển thị danh sách mở rộng
                //expanded = false: hiển thị danh sách rút gọn
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
