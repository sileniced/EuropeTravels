<?php

namespace AppBundle\Form;

use AppBundle\Entity\Prepayments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrepaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('costs')
            ->add('paymentStatus')
            ->add('document1', FileType::class)
            ->add('document2', FileType::class)
            ->add('document3', FileType::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prepayments::class
        ]);
    }
}
