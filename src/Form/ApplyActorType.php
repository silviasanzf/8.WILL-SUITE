<?php
/**
 * Created by PhpStorm.
 * User: davidlavigne
 * Date: 27/11/2018
 * Time: 17:55
 */

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Job;
use App\Entity\SectorJob;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ApplyActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'jobs',
                EntityType::class,
                [
                    'class' => Job::class,
                    'multiple' => true,
                    'expanded' => true
                ]
            )
            ->add(
                'sectorJobs',
                EntityType::class,
                [
                    'class' => SectorJob::class,
                    'multiple' => true,
                    'expanded' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
