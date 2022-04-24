<?php

namespace App\Form;

use App\Entity\Semester;
use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('student')
            // ->add('teacher')
            ->add('assignment1', TextType::class,
            [
                'label'=>'Mark Assignment 1',
                'required' => true
            ])
            ->add('assignment2', TextType::class,
            [
                'label'=>'Mark Assignment 1',
                'required' => true
            ])
            ->add('student', EntityType::class, [
                'label' => 'Student Name',
                'required' => true,
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('subject', EntityType::class, [
                'label' => 'Subject Name',
                'required' => true,
                'class' => Subject::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('semester', EntityType::class, [
                'label' => 'Semester Name',
                'required' => true,
                'class' => Semester::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
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
