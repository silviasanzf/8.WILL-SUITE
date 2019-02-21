<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 09/01/19
 * Time: 16:16
 */

namespace App\Entity;

use spec\GrumPHP\Task\RoboSpec;

class ArtistSearch
{
    /**
     * @var array
     */
    private $transformation=[];
    /**
     * @var array
     */
    private $sectorJob=[];

    /**
     * @var int|null
     */
    private $location;
    /**
     * @var string|null
     */
    private $intermittent;
    /**
     * @var int|null
     */
    private $minSize;
    /**
     * @var int|null
     */
    private $maxSize;
    /**
     * @var int|null
     */
    private $minWeight;
    /**
     * @var int|null
     */
    private $maxWeight;
    /**
     * @var array
     */
    private $colorHair=[];
    /**
     * @var array
     */
    private $textureHair=[];
    /**
     * @var array
     */
    private $hair=[];
    /**
     * @var array
     */
    private $hairiness = [];
    /**
     * @var int|null
     */
    private $progress;
    /**
     * @var array
     */
    private $corpulence = [];
    /**
     * @var array
     */
    private $physical = [];
    /**
     * @var string|null
     */
    private $isactif;
    /**
     * @var string|null
     */
    private $professional;
    /**
     * @var string|null
     */
    private $gender;
    /**
     * @var array
     */
    private $eye=[];
    /**
     * @var int|null
     */
    private $ageMin;


    /**
     * @var int|null
     */
    private $ageMax;
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $aleatory;

    /**
     * @return string|null
     */
    public function getAleatory(): ?string
    {
        return $this->aleatory;
    }

    /**
     * @param string|null $aleatory
     */
    public function setAleatory(?string $aleatory): void
    {
        $this->aleatory = $aleatory;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getAgeMin(): ?int
    {
        return $this->ageMin;
    }
    /**
     * @param int|null $ageMin
     */
    public function setAgeMin(?int $ageMin): void
    {
        $this->ageMin = $ageMin;
    }
    /**
     * @return string|null
     */
    public function getIntermittent(): ?string
    {
        return $this->intermittent;
    }

    /**
     * @param string|null $intermittent
     */
    public function setIntermittent(?string $intermittent): void
    {
        $this->intermittent = $intermittent;
    }
    /**
     * @return int|null
     */
    public function getMinSize(): ?int
    {
        return $this->minSize;
    }

    /**
     * @param int|null $minSize
     */
    public function setMinSize(?int $minSize): void
    {
        $this->minSize = $minSize;
    }

    /**
     * @return int|null
     */
    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    /**
     * @param int|null $maxSize
     */
    public function setMaxSize(?int $maxSize): void
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return int|null
     */
    public function getMinWeight(): ?int
    {
        return $this->minWeight;
    }

    /**
     * @param int|null $minWeight
     */
    public function setMinWeight(?int $minWeight): void
    {
        $this->minWeight = $minWeight;
    }

    /**
     * @return int|null
     */
    public function getMaxWeight(): ?int
    {
        return $this->maxWeight;
    }

    /**
     * @param int|null $maxWeight
     */
    public function setMaxWeight(?int $maxWeight): void
    {
        $this->maxWeight = $maxWeight;
    }

    /**
     * @return array
     */
    public function getColorHair(): array
    {
        return $this->colorHair;
    }

    /**
     * @param array $colorHair
     */
    public function setColorHair(?array $colorHair): void
    {
        $this->colorHair = $colorHair;
    }

    /**
     * @return array
     */
    public function getTextureHair(): array
    {
        return $this->textureHair;
    }

    /**
     * @param array $textureHair
     */
    public function setTextureHair(?array $textureHair): void
    {
        $this->textureHair = $textureHair;
    }

    /**
     * @return array
     */
    public function getHair(): array
    {
        return $this->hair;
    }

    /**
     * @param array $hair
     */
    public function setHair(?array $hair): void
    {
        $this->hair = $hair;
    }

    /**
     * @return array
     */
    public function getHairiness(): array
    {
        return $this->hairiness;
    }

    /**
     * @param array $hairiness
     */
    public function setHairiness(?array $hairiness): void
    {
        $this->hairiness = $hairiness;
    }

    /**
     * @return int|null
     */
    public function getProgress(): ?int
    {
        return $this->progress;
    }

    /**
     * @param int|null $progress
     */
    public function setProgress(?int $progress): void
    {
        $this->progress = $progress;
    }

    /**
     * @return array
     */
    public function getCorpulence(): array
    {
        return $this->corpulence;
    }

    /**
     * @param array $corpulence
     */
    public function setCorpulence(?array $corpulence): void
    {
        $this->corpulence = $corpulence;
    }

    /**
     * @return array
     */
    public function getPhysical(): array
    {
        return $this->physical;
    }

    /**
     * @param array $physical
     */
    public function setPhysical(?array $physical): void
    {
        $this->physical = $physical;
    }

    /**
     * @return string|null
     */
    public function getIsactif(): ?string
    {
        return $this->isactif;
    }

    /**
     * @param string|null $isactif
     */
    public function setIsactif(?string $isactif): void
    {
        $this->isactif = $isactif;
    }

    /**
     * @return string|null
     */
    public function getProfessional(): ?string
    {
        return $this->professional;
    }

    /**
     * @param string|null $professional
     */
    public function setProfessional(?string $professional): void
    {
        $this->professional = $professional;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return array
     */
    public function getEye(): array
    {
        return $this->eye;
    }

    /**
     * @param array $eye
     */
    public function setEye(?array $eye): void
    {
        $this->eye = $eye;
    }
    /**
     * @return int|null
     */
    public function getLocation(): ?int
    {
        return $this->location;
    }

    /**
     * @param int|null $location
     */
    public function setLocation(?int $location): void
    {
        $this->location = $location;
    }
    /**
     * @return int|null
     */
    public function getAgeMax(): ?int
    {
        return $this->ageMax;
    }

    /**
     * @param int|null $ageMax
     */
    public function setAgeMax(?int $ageMax): void
    {
        $this->ageMax = $ageMax;
    }
    /**
     * @return array
     */
    public function getTransformation(): array
    {
        return $this->transformation;
    }

    /**
     * @param array $transformation
     */
    public function setTransformation(array $transformation): void
    {
        $this->transformation = $transformation;
    }

    /**
     * @return array
     */
    public function getSectorJob(): array
    {
        return $this->sectorJob;
    }

    /**
     * @param array $sectorJob
     */
    public function setSectorJob(array $sectorJob): void
    {
        $this->sectorJob = $sectorJob;
    }
}
