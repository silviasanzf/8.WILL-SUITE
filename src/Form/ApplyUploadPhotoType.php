<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 29/11/18
 * Time: 21:01
 */

namespace App\Form;

use App\Entity\Artist;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApplyUploadPhotoType extends AbstractType
{
    /**
     * @var Artist
     */
    private $artist;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->artist = $builder->getData();

        $builder
            ->add('portraitPictureFile1', VichImageType::class, [
                'label' => 'Portrait 1',
                'required' => empty($this->artist->getPortraitPictureName1()),
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('portraitPictureFile2', VichImageType::class, [
                'label' => 'Portrait 2',
                'required' => empty($this->artist->getPortraitPictureName2()),
                'allow_delete' => false,
                'download_label' => 'Aperçu',
                'download_uri' => true,
                'image_uri' => true,
            ])
            ->add('fullPictureFile', VichImageType::class, [
                'label' => 'Photo pied',
                'required' => empty($this->artist->getFullPictureName()),
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
