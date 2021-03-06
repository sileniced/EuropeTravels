<?php

namespace AppBundle\Form;

use AppBundle\Entity\Itinerary;
use AppBundle\Entity\PaymentStatus;
use AppBundle\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
                    'to city'            => 'to city',
                    'to Vince home'      => 'to Vince home',
                    'to home home :('    => 'to home home :(',
                    'to other transport' => 'to other transport',
                    'to hotel'           => 'to hotel',
                    'to attraction'      => 'to attraction',
                    'other'              => 'other'
                ]
            ])
            ->add('address')
            ->add('description')
            ->add('meansOfTransport', ChoiceType::class, [
                'choices' => [
                    'plane' => 'plane',
                    'train' => 'train',
                    'boat'  => 'boat',
                    'bus'   => 'bus',
                    'taxi'  => 'taxi',
                    'car'   => 'car'
                ]
            ])
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
            'data_class' => Transport::class
        ]);
    }
}
