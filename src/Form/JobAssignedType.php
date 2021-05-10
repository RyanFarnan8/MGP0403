<?php

namespace App\Form;

use App\Entity\JobAssigned;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobAssignedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact')
            ->add('description')
            ->add('location')
            ->add('price')
            ->add('creator')
            ->add('trade')
            ->add('county')
            ->add('tradePerson')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobAssigned::class,
        ]);
    }
}
