<?php

namespace AppBundle\Form;

use AppBundle\Entity\PaymentStatus;
use AppBundle\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
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
            'data_class' => Payment::class,
            'attr' => [
                'data-url' => 'api/prepayment'
            ]
        ]);
    }
}
