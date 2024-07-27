<?php

namespace App\Form;



use App\Entity\UserRegister;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class)
        ->add('email', TextType::class)
        
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'required' => true,
            'label' => 'Password'
        ])
            
        
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'required' => true,
            'label' => 'I agree to the terms and conditions'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserRegister::class,
        ]);
    }
}
