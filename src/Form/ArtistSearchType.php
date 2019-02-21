<?php

namespace App\Form;

use App\Entity\ArtistSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'professional',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'choices' => array(
                        'Statut de l\'acteur' => '',
                        'Figurant' => 'Figurant',
                        'Professionnel' => 'Professionnel',
                    )
                )
            )
            ->add(
                'isactif',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'choices' => array(
                        'Statut du profil' => '',
                        'Desactivé' => 'Désactivé',
                        'Actif' => 'Actif',
                    )
                )
            )
            ->add(
                'gender',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'choices' => array(
                        'Genre' => '',
                        'Femme' => '1',
                        'Homme' => '2',
                        'Indéfini' => '3',

                    )
                )
            )
            ->add(
                'corpulence',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(

                        'Maigre' => '2',
                        'Mince' => '3',
                        'Normale' => '4',
                        'Musclée' => '5',
                        'Ronde' => '6',
                        'Obèse' => '7',
                    )
                )
            )
            ->add(
                'physical',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(

                        'Européen' => '1',
                        'Méditerranéen' => '2',
                        'Sud américain' => '3',
                        'Asiatique' => '4',
                        'Nordique' => '5',
                        'Maghrébin' => '6',
                        'Africain' => '7',
                        'Indien' => '8',
                        'Métisse' => '11',
                        'Autre' => '12',

                    )
                )
            )
            ->add(
                'colorHair',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Blonds' => '1',
                        'Bruns' => '2',
                        'Châtain clair' => '3',
                        'Châtain foncé' => '4',
                        'Noirs' => '5',
                        'Roux' => '6',
                        'Blancs' => '7',
                        'Poivre et sel' => '8',
                        'Autre' => '9',
                    )
                )
            )
            ->add(
                'hairiness',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Imberbe' => '1',
                        'Velu' => '2',
                        'Barbe' => '3',
                        'Moustache' => '4',
                        'Collier' => '5',
                        'Bouc' => '6',
                        'Favoris' => '7',
                    )
                )
            )
            ->add(
                'eye',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Bleus' => '6',
                        'Verts' => '2',
                        'Marrons' => '3',
                        'Jaune' => '4',
                        'Vairons' => '5',
                        'Autre' => '7',
                    )
                )
            )
            ->add(
                'hair',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Longs' => '1',
                        'Mi-longs' => '2',
                        'Courts' => '3',
                        'Rasés' => '4',
                        'Dégarnis' => '5',
                        'Clairsemés' => '6',
                        'Chauve' => '7',
                        'Tonsure' => '8',
                    )
                )
            )
            ->add(
                'textureHair',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Raides' => '1',
                        'Ondulés' => '2',
                        'Bouclés' => '3',
                        'Frisés' => '4',
                        'Crépus' => '5',
                        'Brosse' => '6',
                        'Rasta' => '7',
                        'Autre' => '8',
                    )
                )
            )
            ->add(
                'intermittent',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'choices' => array(
                        'Intermittence' => '',
                        'NON' => 'non',
                        'OUI' => 'oui',
                        'En cours' => 'En cours',
                    )
                )
            )
            ->add('minSize', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'taille min.'
                )
            ))
            ->add('maxSize', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'taille max.'
                )
            ))
            ->add('minWeight', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'poids min.'
                )
            ))
            ->add('maxWeight', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'poids max.'
                )
            ))
            ->add('progress', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'progression min'
                )
            ))
            ->add('name', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'nom prénom ou pseudo'
                )
            ))
            ->add('aleatory', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'aléatoire'
                )
            ))
            ->add('location', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'département ou CP'
                )
            ))
            ->add('ageMin', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'age min'
                )
            ))
            ->add('ageMax', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'age max'
                )
            ))
            ->add(
                'sectorJob',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'cinéma, long-métrage' => '1',
                        'cinéma, court-métrage' => '2',
                        'téléfilm' => '3',
                        'film institutionnel d\'entreprise' => '4',
                        'vidéo musical (clip)' => '5',
                        'spot publicitaire' => '6',
                        'affichage publicitaire' => '7',
                        'photo publicitaire' => '8',
                        'photo illustration presse' => '9',
                        'cd-rom internet' => '10',
                    )
                )
            )
            ->add(
                'transformation',
                ChoiceType::class,
                array(
                    'label' => false,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => array(
                        'Porter des lentilles de couleur' => '1',
                        'Me faire couper les cheveux' => '2',
                        'Me faire teindre les cheveux' => '3',
                        'Porter une perruque' => '4',
                    )
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArtistSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }
}
