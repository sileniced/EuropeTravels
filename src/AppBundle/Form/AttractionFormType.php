<?php

namespace AppBundle\Form;

use AppBundle\Entity\Attraction;
use AppBundle\Entity\Itinerary;
use AppBundle\Entity\PaymentStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttractionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', ChoiceType::class, [
                'choices' => [
                    'Düsseldorf' => 'Düsseldorf',
                    'Venice'     => 'Venice',
                    'London'     => 'London',
                    'Prague'     => 'Santorini',
                    'Paris'      => 'Paris',
                    'other'      => 'other'
                ]
            ])
            ->add('description')
            ->add('link')
            ->add('address')
            ->add('itinerary', ItineraryEmbeddedForm::class, [
                'data_class' => Itinerary::class
            ])
            ->add('paymentStatus', PaymentStatusEmbeddedForm::class, [
                'data_class' => PaymentStatus::class
            ])
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
            'data_class' => Attraction::class,
            'attr' => [
                'data-url' => '/api/attraction'
            ]
        ]);
    }
}
