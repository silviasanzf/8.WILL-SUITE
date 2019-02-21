<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('shooting_date')
            ->add('format')
            ->add('duration')
            ->add('production')
            ->add('broadcast')
            ->add('segment_number')
            ->add('executive_production')
            ->add('delegated_production')
            ->add('sponsor')
            ->add('producer')
            ->add('executive_producer')
            ->add('director')
            ->add('production_manager')
            ->add('production_administrator')
            ->add('production_assistant')
            ->add('casting_director')
            ->add('distribution_director')
            ->add('casting_assistant')
            ->add('lead_assistant')
            ->add('support')
            ->add('synopsis')
            ->add('productionCompagny')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
