<?php
/**
 * Created by PhpStorm.
 * User: davidlavigne
 * Date: 27/11/2018
 * Time: 17:55
 */

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ApplyExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('school')
            ->add('degree')
            ->add('conservatory')
            ->add('experiences', null, ['required' => true])
            ->add('practiceSports')
            ->add(
                'levelDegree',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'Niveau de diplôme' => '',
                        'Aucun diplôme'=> '0',
                        'BEP/CAP ou équivalent' =>'1' ,
                        'BAC ou équivalent' => '2',
                        'BAC +2' => '3',
                        'BAC+3' => '4',
                        'BAC+4 et plus' => '5',
                    )
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
