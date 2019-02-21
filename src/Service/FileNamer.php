<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 25/01/19
 * Time: 09:57
 */

namespace App\Service;

use App\Entity\Artist;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class FileNamer implements NamerInterface
{
    /**
     * @param Artist $artist
     * @param PropertyMapping $mapping
     * @return string
     */
    public function name($artist, PropertyMapping $mapping): string
    {
        $file = $mapping->getFile($artist);
        $fileName = strtolower($artist->getBirthName() . '_' .  $artist->getFirstname());
        $fileName.= '_' . str_replace('File', '', $mapping->getFilePropertyName());
        $fileName.= '_' . date('dmY');
        if ($file) {
            $fileName .= '.' . $file->guessExtension();
        }
        return $fileName;
    }
}
