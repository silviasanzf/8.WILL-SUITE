<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 10/01/19
 * Time: 10:48
 */

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ApplyUploadDocumentType extends AbstractType
{
    /**
     * @var Artist
     */
    private $artist;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->artist = $builder->getData();

        $builder
            ->add('cvFile', VichImageType::class, [
                'label' => 'CV',
                'required' => empty($this->artist->getCvName()),
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('ribFile', VichImageType::class, [
                'label' => 'RIB',
                'required' => empty($this->artist->getRibName()),
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('socialCardFile', VichImageType::class, [
                'label' => 'Carte vitale',
                'required' => empty($this->artist->getSocialCardName()),
                'allow_delete' => false,
                'download_label' => 'Aperçu.',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('identityCardFile', VichImageType::class, [
                'label' => 'Carte d\'identité',
                'required' => empty($this->artist->getIdentityCardName()),
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('residencePermitFile', VichImageType::class, [
                'label' => 'Titre de séjour',
                'required' => false,
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('cmbFile', VichImageType::class, [
                'label' => 'cmb (si intermitent)',
                'required' => false,
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
