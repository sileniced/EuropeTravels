<?php

namespace AppBundle\Form;

use AppBundle\Entity\Hotels;
use AppBundle\FormType\LocalDateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', ChoiceType::class, [
                'choices' => [
                    'Düsseldorf' => 'Düsseldorf',
                    'Venice' => 'Venice',
                    'London' => 'London',
                    'Prague' => 'Santorini',
                    'Paris' => 'Paris',
                    'other' => 'other'
                ]
            ])
            ->add('description')
            ->add('link')
            ->add('address')
            ->add('startsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('endsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
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
            'data_class' => Hotels::class,
            'attr' => [
                'data-url' => 'api/hotel'
            ]
        ]);
    }
}
