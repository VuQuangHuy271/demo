<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\Subject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomAddDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('subjects', EntityType::class, [
            //     'label' => 'Subject Name',
            //     'required' => true,
            //     'class' => Subject::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true
            // ])
            ->add('student', EntityType::class, [
                'label' => 'Student Name',
                'required' => true,
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            //multiple = true: ManyToMany, OneToMany => có thể chọn nhiều item
            //multiple = false: OneToOne, ManyToOne => chỉ được chọn 1 item
            //expanded = true: hiển thị danh sách mở rộng
            //expanded = false: hiển thị danh sách rút gọn
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
