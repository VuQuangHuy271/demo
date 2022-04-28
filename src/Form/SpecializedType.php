<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SpecializedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label'=> 'Name',
                'attr' => [
                    'placeholder' => 'Enter Name Specialize'],
                'required' => true,
            ])
            ->add('Description', TextType::class, [
                'label'=> 'Description',
                'attr' => [
                    'placeholder' => 'Enter Name Description'],
                'required' => true,
            ])
            // ->add('teachers', EntityType::class, [
            //     'label' => 'Teacher Name',
            //     'required' => true,
            //     'class' => Teacher::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'attr' => [
            //         'class' => 'form-group',
            //         'style' => 'border: 2px solid ;'
            //     ]
            // ])
            // ->add('student', EntityType::class, [
            //     'label' => 'Student Name',
            //     'required' => true,
            //     'class' => Student::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'attr' => [
            //         'class' => 'form-group',
            //         'style' => 'border: 2px solid ;'
            //     ]
            // ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
