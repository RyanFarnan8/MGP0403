<?php

namespace App\Form;

use App\Entity\MyJobApplications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyJobApplicationsType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyJobApplications::class,
        ]);
    }
}
