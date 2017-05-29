<?php

namespace AppBundle\Form;

use AppBundle\Entity\PaymentStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentStatusEmbeddedForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('costs')
            ->add('paymentStatus', ChoiceType::class, [
                'choices' => [
                    'Booked CC 4086'  => 'Booked CC 4086',
                    'Booked CC 7501'  => 'Booked CC 7501',
                    'Charged CC 4086' => 'Charged CC 4086',
                    'Charged CC 7501' => 'Charged CC 7501',
                    'Completed'       => 'Completed',
                    'To be paid cash' => 'To be paid cash',
                    'To be paid CC'   => 'To be paid CC'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaymentStatus::class
        ]);
    }
}
