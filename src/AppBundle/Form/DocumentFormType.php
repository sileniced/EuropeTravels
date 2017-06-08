<?php

namespace AppBundle\Form;

use AppBundle\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'general' => 'general',
                    'transport' => 'transport',
                    'hotel' => 'hotel',
                    'attraction' => 'attraction',
                    'other' => 'other'
                ]
            ])
            ->add('document', FileType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
            'attr' => [
                'data-url' => 'api/document'
            ]
        ]);
    }
}
