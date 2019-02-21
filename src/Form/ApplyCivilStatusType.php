<?php
/**
 * Created by PhpStorm.
 * User: davidlavigne
 * Date: 27/11/2018
 * Time: 17:55
 */

namespace App\Form;

use App\Entity\Artist;
use App\Entity\DrivingLicence;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplyCivilStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthName', null, ['required' => true])
            ->add('marriedName')
            ->add('firstname', null, ['required' => true])
            ->add('pseudonym')
            ->add('gender')
            ->add(
                'birthDate',
                DateType::class,
                [
                    'required' => true,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'],
                    'format' => 'dd/MM/yyyy'
                ]
            )
            ->add('birthCity', null, ['required' => true])
            ->add('birthDept', null, ['required' => true])
            ->add('birthCountry', null, ['required' => true])
            ->add('nationality', null, ['required' => true])
            ->add(
                'maritalStatus',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'Choisissez un statut' => '',
                        'Célibataire' => '0',
                        'Marié(e)' => '1',
                        'Pacsé(e)' => '2',
                        'Veuf/veuve' => '3',
                        'Vis maritalement' => '4',
                    )
                )
            )
            ->add('dependentChild', null, ['required' => true])
            ->add(
                'lastMedicalVisit',
                DateType::class,
                [
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'],
                    'format' => 'dd/MM/yyyy'
                ]
            )
            ->add('socialSecurityNo', null, ['required' => true])
            ->add(
                'intermittent',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'définissez votre situation' => '',
                        'NON' => 'non',
                        'OUI' => 'oui',
                        'En cours' => 'En cours',
                    )
                )
            )
            ->add('showNo')
            ->add('address', null, ['required' => true])
            ->add('zipCode', null, ['required' => true])
            ->add('city', null, ['required' => true])
            ->add('residentPermitNo')
            ->add(
                'expiryDateResident',
                DateType::class,
                [
                    'required' => false,
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'],
                    'format' => 'dd/MM/yyyy'
                ]
            )
            ->add('taxAddress')
            ->add('zipCodeTax')
            ->add('taxCity')
            ->add('phone', null, ['required' => true])
            ->add('homePhone')
            ->add('email', null, ['required' => true])
            ->add(
                'drivingLicences',
                EntityType::class,
                [
                    'class' => DrivingLicence::class,
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
            ->add(
                'transports',
                EntityType::class,
                [
                    'class' => Transport::class,
                    'multiple' => true,
                    'expanded' => true,

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
