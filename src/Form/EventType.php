<?php
namespace App\Form;

use App\Entity\EventDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $today = new \DateTime();
    
    $builder
        ->add('name', TextType::class)
        ->add('StartDate', DateTimeType::class, [
            'attr' => [
                'min' => $today->format('Y-m-d H:i'), // Set the minimum date to today
            ],
            'widget' => 'single_text',
        ])
        ->add('EndDate', DateTimeType::class, [
            'attr' => [
                'min' => $today->format('Y-m-d H:i'), // Set the minimum date to today
            ],
            'widget' => 'single_text',
        ])
        ->add('Location', ChoiceType::class, [
            'choices' => [
                'Enter location of event' => null,
                'Zoom' => 'Zoom',
                'Google Meet' => 'Google Meet',
            ],
            'attr' => ['class' => 'form-select', 'required' => true]
        ]);
}

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventDetails::class,
        ]);
    }
}
