<?php

namespace AppBundle\Form;

use AppBundle\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meansOfTransport', ChoiceType::class, [
                'choices' => [
                    'plane' => 'plane',
                    'train' => 'train',
                    'boat' => 'boat',
                    'taxi' => 'taxi'

                ]
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'to other transport' => 'to other transport',
                    'to hotel' => 'to hotel',
                    'to attraction' => 'to attraction',
                    'other' => 'other'
                ]
            ])
            ->add('transporter')
            ->add('transportReference')
            ->add('reservationNumber')
            ->add('link')
            ->add('depart', null, [
                'label' => 'departs from'
            ])
            ->add('startsAt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'departs at'
            ])
            ->add('arrival', null, [
                'label' => 'arrives at'
            ])
            ->add('endsAt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'arrival at'
            ])
            ->add('costs')
            ->add('paymentStatus')
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transport::class
        ]);
    }
}
