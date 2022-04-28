<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
                    'maxlength' => 5,
                    'minlength' => 30
                ]

            ])
            ->add('dateStart', DateType::class, [
                'label'=>'Published date',
                'required' => true,
                'widget' => 'single_text',
            ])
            ->add('dateEnd', DateType::class, [
                
                'label'=>'Published date',
                'required' => true,
                'widget' => 'single_text'  ,
                //Set the dateEnd to be greater than the dateStart
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
