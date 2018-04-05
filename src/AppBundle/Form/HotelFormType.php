<?php

namespace AppBundle\Form;

use AppBundle\Entity\Destination;
use AppBundle\Entity\Hotel;
use AppBundle\Entity\Itinerary;
use AppBundle\Entity\PaymentStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'multiple' => false,
                'expanded' => false,
                'choice_label' => 'name'
            ])
            ->add('name')
            ->add('link')
            ->add('address')
            ->add('itinerary', ItineraryEmbeddedForm::class, [
                'data_class' => Itinerary::class
            ])
            ->add('paymentStatus', PaymentStatusEmbeddedForm::class, [
                'data_class' => PaymentStatus::class
            ])
            ->add('documents', CollectionType::class, [
                'entry_type' => DocumentEmbeddedForm::class,
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class
        ]);
    }
}
