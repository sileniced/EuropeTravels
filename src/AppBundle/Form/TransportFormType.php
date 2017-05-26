<?php

namespace AppBundle\Form;

use AppBundle\Entity\Transport;
use AppBundle\FormType\LocalDateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'to city' => 'to city',
                    'to Vince home' => 'to Vince home',
                    'to home home :(' => 'to home home :(',
                    'to other transport' => 'to other transport',
                    'to hotel' => 'to hotel',
                    'to attraction' => 'to attraction',
                    'other' => 'other'
                ]
            ])
            ->add('description')
            ->add('meansOfTransport', ChoiceType::class, [
                'choices' => [
                    'plane' => 'plane',
                    'train' => 'train',
                    'boat' => 'boat',
                    'taxi' => 'taxi'

                ]
            ])
            ->add('startsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'departs at'
            ])
            ->add('endsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'arrival at'
            ])
            ->add('costs')
            ->add('paymentStatus')
            ->add('documentDescription1')
            ->add('document1', FileType::class, ['required' => false])
            ->add('documentDescription2')
            ->add('document2', FileType::class, ['required' => false])
            ->add('documentDescription3')
            ->add('document3', FileType::class, ['required' => false])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transport::class
        ]);
    }
}
