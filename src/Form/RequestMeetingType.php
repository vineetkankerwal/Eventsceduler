<?php
namespace App\Form;
use App\Entity\MeetingRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class RequestMeetingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Fname', TextType::class)
        ->add('Lname', TextType::class)
        ->add('email',  TextType::class)
        ->add('ChooseDateTime',  DateTimeType::class)
        ->add('purpose',  TextType::class);   
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MeetingRequest::class,
        ]);
    }
}
