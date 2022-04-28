<?php

namespace App\Form;
use App\Entity\Subject;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Name', 
                'attr' => ['placeholder' => 'Enter Name Classroom'],
                'required' => true,
            ])
            ->add('Subject', EntityType::class, [
                'label' => 'Subject Name',
                'required' => true,
                'class' => Subject::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('save', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
