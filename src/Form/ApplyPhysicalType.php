<?php
/**
 * Created by PhpStorm.
 * User: davidlavigne
 * Date: 27/11/2018
 * Time: 17:55
 */

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Transformation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ApplyPhysicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformations = ['hairCut', 'hairColoration', 'colorContactLens'];
        $builder
            ->add('height', null, ['required' => true])
            ->add('weight', null, ['required' => true])
            ->add('physical', null, ['required' => true])
            ->add('hairiness')
            ->add('hair', null, ['required' => true])
            ->add('textureHair', null, ['required' => true])
            ->add('colorHair', null, ['required' => true])
            ->add('eye', null, ['required' => true])
            ->add('chestSize', null, ['required' => true])
            ->add('hipSize', null, ['required' => true])
            ->add('waistSize', null, ['required' => true])
            ->add('skirtSize')
            ->add('jacketSize', null, ['required' => true])
            ->add('pantsSize', null, ['required' => true])
            ->add('shoesSize', null, ['required' => true])
            ->add('headCirconference', null, ['required' => true])
            ->add('braSize')
            ->add(
                'cupSize',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'A' => '0',
                        'B' => '1',
                        'C' => '2',
                        'D' => '3',
                        'E' => '4',
                        'F' => '5',
                        'G ou +' => '6',
                    )
                )
            )
            ->add('handicap')
            ->add('distinctiveSign')
            ->add('corpulence')
            ->add(
                'transformations',
                EntityType::class,
                [
                    'class' => Transformation::class,
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
