<?php

namespace App\Form;



use App\Entity\UserRegister;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
       
        ->add('email', TextType::class)
        
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'required' => true,
            'label' => 'Password'
        ]);
            
        
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserRegister::class,
        ]);
    }
}
