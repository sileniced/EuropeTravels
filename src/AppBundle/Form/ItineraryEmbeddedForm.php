<?php

namespace AppBundle\Form;

use AppBundle\Entity\Itinerary;
use AppBundle\FormType\LocalDateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItineraryEmbeddedForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('endsAt', LocalDateTimeType::class, [
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Itinerary::class
        ]);
    }
}
