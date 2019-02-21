<?php

namespace App\Form;

use App\Entity\ProductionCompagny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionCompagnyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('status')
            ->add('siret')
            ->add('ape')
            ->add('naf')
            ->add('capital')
            ->add('ceo')
            ->add('logo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductionCompagny::class,
        ]);
    }
}
