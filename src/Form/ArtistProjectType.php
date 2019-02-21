<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 17/01/19
 * Time: 14:51
 */

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\ArtistRepository;

class ArtistProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'artists',
                EntityType::class,
                [
                    'class' => Artist::class,
                    'query_builder' => function (ArtistRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.birthName', 'ASC');
                    },
                    'choice_label' => 'fullname',
                    'multiple' => true,
                    'attr' => ['class' => 'artistProject'],
                    'by_reference' => false,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
