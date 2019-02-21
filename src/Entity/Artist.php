<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 * @Vich\Uploadable
 * @UniqueEntity("email")
 */
class Artist implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progress;

    /**
     * @Assert\Regex(pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", match=true,
     *      message="le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":null})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marriedName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudonym;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthCity;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $birthDept;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dependentChild;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastMedicalVisit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^[(0-9)]{15}$/", match=true, message="15 chiffres sans espaces ni tirets")
     */
    private $socialSecurityNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $showNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^[0-9]{5,5}$/", match=true, message="Veuillez vérifier votre saisie")
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/", match=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $homePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $school;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $degree;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $conservatory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $experiences;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $practiceSports;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $handicap;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $distinctiveSign;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $professional;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $extra;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isactif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $chestSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hipSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $waistSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $skirtSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jacketSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pantsSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shoesSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $headCirconference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $braSize;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cupSize;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DrivingLicence", inversedBy="artists")
     */
    private $drivingLicences;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Transport", inversedBy="artists")
     */
    private $transports;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Job", inversedBy="artists")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SectorJob", inversedBy="artists")
     */
    private $sectorJobs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Transformation", inversedBy="artists")
     */
    private $transformations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ColorHair", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $colorHair;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corpulence", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $corpulence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eye", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $eye;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hair", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $hair;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hairiness", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $hairiness;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Physical", inversedBy="artists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $physical;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $residentPermitNo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expiryDateResident;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taxAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^[0-9]{5,5}$/", match=true, message="Veuillez vérifier votre saisie")
     */
    private $zipCodeTax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taxCity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", mappedBy="artists")
     */
    private $projects;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="portraitPictureName1",
     * size="portraitPictureSize1")
     *
     * @var null|File
     */
    private $portraitPictureFile1 = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $portraitPictureName1 = null;
    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $portraitPictureSize1 = null;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt1;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="portraitPictureName2",
     * size="portraitPictureSize2")
     *
     * @var null|File
     */
    private $portraitPictureFile2 = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var null|string
     */
    private $portraitPictureName2 = null;
    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var null|integer
     */
    private $portraitPictureSize2 = null;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt2;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="fullPictureName", size="fullPictureSize")
     *
     * @var null|File
     */
    private $fullPictureFile = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var null|string
     */
    private $fullPictureName = null;
    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var null|integer
     */
    private $fullPictureSize = null;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt3;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gender", inversedBy="artists")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TextureHair", inversedBy="artists")
     */
    private $textureHair;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="cvName", size="cvSize")
     *
     * @var File|null
     */
    private $cvFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string|null
     */
    private $cvName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer|null
     */
    private $cvSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt4;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="ribName", size="ribSize")
     *
     * @var File|null
     */
    private $ribFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $ribName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer
     */
    private $ribSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt5;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="socialCardName", size="socialCardSize")
     *
     * @var File|null
     */
    private $socialCardFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string|null
     */
    private $socialCardName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer|null
     */
    private $socialCardSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt6;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="identityCardName", size="identityCardSize")
     *
     * @var File|null
     */
    private $identityCardFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string|null
     */
    private $identityCardName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer|null
     */
    private $identityCardSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt7;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="residencePermitName", size="residencePermitSize")
     *
     * @var File|null
     */
    private $residencePermitFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string|null
     */
    private $residencePermitName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer|null
     */
    private $residencePermitSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt8;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="cmbName", size="cmbSize")
     *
     * @var File|null
     */
    private $cmbFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string|null
     */
    private $cmbName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer|null
     */
    private $cmbSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt9;


    /**
     * @ORM\Column(type="string", length=255, options={"default":null}, nullable=true)
     */
    private $levelDegree;

    /**
     * @ORM\Column(type="string", length=255, options={"default":null}, nullable=true)
     */
    private $intermittent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", inversedBy="candidates")
     */
    private $castings;


    /**
     * Artist constructor.
     */
    public function __construct()
    {
        $this->drivingLicences = new ArrayCollection();
        $this->transports = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->sectorJobs = new ArrayCollection();
        $this->transformations = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->castings = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Artist
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMarriedName(): ?string
    {
        return $this->marriedName;
    }

    /**
     * @param string $marriedName
     * @return Artist
     */
    public function setMarriedName(string $marriedName): self
    {
        $this->marriedName = $marriedName;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthName(): ?string
    {
        return $this->birthName;
    }

    /**
     * @param string $birthName
     * @return Artist
     */
    public function setBirthName(string $birthName): self
    {
        $this->birthName = $birthName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    /**
     * @param null|string $pseudonym
     * @return Artist
     */
    public function setPseudonym(?string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTimeInterface $birthDate
     * @return Artist
     */
    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthCity(): ?string
    {
        return $this->birthCity;
    }

    /**
     * @param string $birthCity
     * @return Artist
     */
    public function setBirthCity(string $birthCity): self
    {
        $this->birthCity = $birthCity;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDept(): ?string
    {
        return $this->birthDept;
    }

    /**
     * @param string $birthDept
     * @return Artist
     */
    public function setBirthDept(string $birthDept): self
    {
        $this->birthDept = $birthDept;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthCountry(): ?string
    {
        return $this->birthCountry;
    }

    /**
     * @param string $birthCountry
     * @return Artist
     */
    public function setBirthCountry(?string $birthCountry): self
    {
        $this->birthCountry = $birthCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     * @return Artist
     */
    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return string
     */
    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     * @return Artist
     */
    public function setMaritalStatus(?string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * @return int
     */
    public function getDependentChild(): ?int
    {
        return $this->dependentChild;
    }

    /**
     * @param int $dependentChild
     * @return Artist
     */
    public function setDependentChild(?int $dependentChild): self
    {
        $this->dependentChild = $dependentChild;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastMedicalVisit(): ?\DateTimeInterface
    {
        return $this->lastMedicalVisit;
    }

    /**
     * @param \DateTimeInterface|null $lastMedicalVisit
     * @return Artist
     */
    public function setLastMedicalVisit(?\DateTimeInterface $lastMedicalVisit): self
    {
        $this->lastMedicalVisit = $lastMedicalVisit;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocialSecurityNo(): ?string
    {
        return $this->socialSecurityNo;
    }

    /**
     * @param string $socialSecurityNo
     * @return Artist
     */
    public function setSocialSecurityNo(string $socialSecurityNo): self
    {
        $this->socialSecurityNo = $socialSecurityNo;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getShowNo(): ?string
    {
        return $this->showNo;
    }

    /**
     * @param null|string $showNo
     * @return Artist
     */
    public function setShowNo(?string $showNo): self
    {
        $this->showNo = $showNo;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Artist
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Artist
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Artist
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Artist
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHomePhone(): ?string
    {
        return $this->homePhone;
    }

    /**
     * @param string|null $homePhone
     * @return Artist
     */
    public function setHomePhone(?string $homePhone): self
    {
        $this->homePhone = $homePhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Artist
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchool(): ?string
    {
        return $this->school;
    }

    /**
     * @param string $school
     * @return Artist
     */
    public function setSchool(?string $school): self
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return string
     */
    public function getDegree(): ?string
    {
        return $this->degree;
    }

    /**
     * @param string $degree
     * @return Artist
     */
    public function setDegree(?string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getConservatory(): ?string
    {
        return $this->conservatory;
    }

    /**
     * @param null|string $conservatory
     * @return Artist
     */
    public function setConservatory(?string $conservatory): self
    {
        $this->conservatory = $conservatory;

        return $this;
    }

    /**
     * @return string
     */
    public function getExperiences(): ?string
    {
        return $this->experiences;
    }

    /**
     * @param string $experiences
     * @return Artist
     */
    public function setExperiences(string $experiences): self
    {
        $this->experiences = $experiences;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPracticeSports(): ?string
    {
        return $this->practiceSports;
    }

    /**
     * @param null|string $practiceSports
     * @return Artist
     */
    public function setPracticeSports(?string $practiceSports): self
    {
        $this->practiceSports = $practiceSports;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Artist
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return Artist
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHandicap(): ?string
    {
        return $this->handicap;
    }

    /**
     * @param null|string $handicap
     * @return Artist
     */
    public function setHandicap(?string $handicap): self
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDistinctiveSign(): ?string
    {
        return $this->distinctiveSign;
    }

    /**
     * @param null|string $distinctiveSign
     * @return Artist
     */
    public function setDistinctiveSign(?string $distinctiveSign): self
    {
        $this->distinctiveSign = $distinctiveSign;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * @param null|string $video
     * @return Artist
     */
    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return bool
     */
    public function getProfessional(): ?bool
    {
        return $this->professional;
    }

    /**
     * @param bool $professional
     * @return Artist
     */
    public function setProfessional(bool $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExtra(): ?bool
    {
        return $this->extra;
    }

    /**
     * @param bool $extra
     * @return Artist
     */
    public function setExtra(bool $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsactif(): ?bool
    {
        return $this->isactif;
    }

    /**
     * @param bool $isactif
     * @return Artist
     */
    public function setIsactif(bool $isactif): self
    {
        $this->isactif = $isactif;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Artist
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return int
     */
    public function getChestSize(): ?int
    {
        return $this->chestSize;
    }

    /**
     * @param int $chestSize
     * @return Artist
     */
    public function setChestSize(int $chestSize): self
    {
        $this->chestSize = $chestSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getHipSize(): ?int
    {
        return $this->hipSize;
    }

    /**
     * @param int $hipSize
     * @return Artist
     */
    public function setHipSize(int $hipSize): self
    {
        $this->hipSize = $hipSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getWaistSize(): ?int
    {
        return $this->waistSize;
    }

    /**
     * @param int $waistSize
     * @return Artist
     */
    public function setWaistSize(int $waistSize): self
    {
        $this->waistSize = $waistSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getSkirtSize(): ?int
    {
        return $this->skirtSize;
    }

    /**
     * @param int $skirtSize
     * @return Artist
     */
    public function setSkirtSize(?int $skirtSize): self
    {
        $this->skirtSize = $skirtSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getJacketSize(): ?int
    {
        return $this->jacketSize;
    }

    /**
     * @param int $jacketSize
     * @return Artist
     */
    public function setJacketSize(int $jacketSize): self
    {
        $this->jacketSize = $jacketSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getPantsSize(): ?int
    {
        return $this->pantsSize;
    }

    /**
     * @param int $pantsSize
     * @return Artist
     */
    public function setPantsSize(int $pantsSize): self
    {
        $this->pantsSize = $pantsSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getShoesSize(): ?int
    {
        return $this->shoesSize;
    }

    /**
     * @param int $shoesSize
     * @return Artist
     */
    public function setShoesSize(int $shoesSize): self
    {
        $this->shoesSize = $shoesSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeadCirconference(): ?int
    {
        return $this->headCirconference;
    }

    /**
     * @param int $headCirconference
     * @return Artist
     */
    public function setHeadCirconference(int $headCirconference): self
    {
        $this->headCirconference = $headCirconference;

        return $this;
    }

    /**
     * @return int
     */
    public function getBraSize(): ?int
    {
        return $this->braSize;
    }

    /**
     * @param int $braSize
     * @return Artist
     */
    public function setBraSize(?int $braSize): self
    {
        $this->braSize = $braSize;

        return $this;
    }

    /**
     * @return string
     */
    public function getCupSize(): ?string
    {
        return $this->cupSize;
    }

    /**
     * @param string $cupSize
     * @return Artist
     */
    public function setCupSize(?string $cupSize): self
    {
        $this->cupSize = $cupSize;

        return $this;
    }

    /**
     * @return Collection|DrivingLicence[]
     */
    public function getDrivingLicences(): Collection
    {
        return $this->drivingLicences;
    }

    /**
     * @param DrivingLicence $drivingLicence
     * @return Artist
     */
    public function addDrivingLicence(DrivingLicence $drivingLicence): self
    {
        if (!$this->drivingLicences->contains($drivingLicence)) {
            $this->drivingLicences[] = $drivingLicence;
        }

        return $this;
    }

    /**
     * @param DrivingLicence $drivingLicence
     * @return Artist
     */
    public function removeDrivingLicence(DrivingLicence $drivingLicence): self
    {
        if ($this->drivingLicences->contains($drivingLicence)) {
            $this->drivingLicences->removeElement($drivingLicence);
        }

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    /**
     * @param Transport $transport
     * @return Artist
     */
    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
        }

        return $this;
    }

    /**
     * @param Transport $transport
     * @return Artist
     */
    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->contains($transport)) {
            $this->transports->removeElement($transport);
        }

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return Artist
     */
    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
        }

        return $this;
    }

    /**
     * @param Job $job
     * @return Artist
     */
    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
        }

        return $this;
    }

    /**
     * @return Collection|SectorJob[]
     */
    public function getSectorJobs(): Collection
    {
        return $this->sectorJobs;
    }

    /**
     * @param SectorJob $sectorJob
     * @return Artist
     */
    public function addSectorJob(SectorJob $sectorJob): self
    {
        if (!$this->sectorJobs->contains($sectorJob)) {
            $this->sectorJobs[] = $sectorJob;
        }

        return $this;
    }

    /**
     * @param SectorJob $sectorJob
     * @return Artist
     */
    public function removeSectorJob(SectorJob $sectorJob): self
    {
        if ($this->sectorJobs->contains($sectorJob)) {
            $this->sectorJobs->removeElement($sectorJob);
        }

        return $this;
    }

    /**
     * @return Collection|Transformation[]
     */
    public function getTransformations(): Collection
    {
        return $this->transformations;
    }

    /**
     * @param Transformation $transformation
     * @return Artist
     */
    public function addTransformation(Transformation $transformation): self
    {
        if (!$this->transformations->contains($transformation)) {
            $this->transformations[] = $transformation;
        }

        return $this;
    }

    /**
     * @param Transformation $transformation
     * @return Artist
     */
    public function removeTransformation(Transformation $transformation): self
    {
        if ($this->transformations->contains($transformation)) {
            $this->transformations->removeElement($transformation);
        }

        return $this;
    }

    /**
     * @return ColorHair|null
     */
    public function getColorHair(): ?ColorHair
    {
        return $this->colorHair;
    }
    /**
     * @param ColorHair|null $colorHair
     * @return Artist
     */
    public function setColorHair(?ColorHair $colorHair): self
    {
        $this->colorHair = $colorHair;
        return $this;
    }


    /**
     * @return Corpulence|null
     */
    public function getCorpulence(): ?Corpulence
    {
        return $this->corpulence;
    }
    /**
     * @param Corpulence|null $corpulence
     * @return Artist
     */
    public function setCorpulence(?Corpulence $corpulence): self
    {
        $this->corpulence = $corpulence;
        return $this;
    }

    /**
     * @return Eye|null
     */
    public function getEye(): ?Eye
    {
        return $this->eye;
    }
    /**
     * @param Eye|null $eye
     * @return Artist
     */
    public function setEye(?Eye $eye): self
    {
        $this->eye = $eye;
        return $this;
    }

    /**
     * @return Hair|null
     */
    public function getHair(): ?Hair
    {
        return $this->hair;
    }
    /**
     * @param Hair|null $hair
     * @return Artist
     */
    public function setHair(?Hair $hair): self
    {
        $this->hair = $hair;
        return $this;
    }


    /**
     * @return Hairiness|null
     */
    public function getHairiness(): ?Hairiness
    {
        return $this->hairiness;
    }

    /**
     * @param Hairiness|null $hairiness
     * @return Artist
     */
    public function setHairiness(?Hairiness $hairiness): self
    {
        $this->hairiness = $hairiness;

        return $this;
    }

    /**
     * @return Physical|null
     */
    public function getPhysical(): ?Physical
    {
        return $this->physical;
    }
    /**
     * @param Physical|null $physical
     * @return Artist
     */
    public function setPhysical(?Physical $physical): self
    {
        $this->physical = $physical;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getResidentPermitNo(): ?string
    {
        return $this->residentPermitNo;
    }

    /**
     * @param null|string $residentPermitNo
     * @return Artist
     */
    public function setResidentPermitNo(?string $residentPermitNo): self
    {
        $this->residentPermitNo = $residentPermitNo;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getExpiryDateResident(): ?\DateTimeInterface
    {
        return $this->expiryDateResident;
    }

    /**
     * @param null|\DateTimeInterface $expiryDateResident
     * @return Artist
     */
    public function setExpiryDateResident(?\DateTimeInterface $expiryDateResident): self
    {
        $this->expiryDateResident = $expiryDateResident;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxAddress(): ?string
    {
        return $this->taxAddress;
    }

    /**
     * @param string|null $taxAddress
     * @return Artist
     */
    public function setTaxAddress(?string $taxAddress): self
    {
        $this->taxAddress = $taxAddress;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipCodeTax(): ?string
    {
        return $this->zipCodeTax;
    }

    /**
     * @param string|null $zipCodeTax
     * @return Artist
     */
    public function setZipCodeTax(?string $zipCodeTax): self
    {
        $this->zipCodeTax = $zipCodeTax;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxCity(): ?string
    {
        return $this->taxCity;
    }

    /**
     * @param string|null $taxCity
     * @return Artist
     */
    public function setTaxCity(?string $taxCity): self
    {
        $this->taxCity = $taxCity;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    /**
     * @param Project $project
     * @return Artist
     */
    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addArtist($this);
        }

        return $this;
    }

    /**
     * @param Project $project
     * @return Artist
     */
    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeArtist($this);
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getPortraitPictureFile1(): ?File
    {
        return $this->portraitPictureFile1;
    }
    /**
     * @param null|File $portraitPictureName1
     * @throws \Exception
     */
    public function setPortraitPictureFile1(?File $portraitPictureName1 = null): void
    {
        $this->portraitPictureFile1 = $portraitPictureName1;
        if (null !== $portraitPictureName1) {
            $this->updatedAt1 = new \DateTime('now');
        }
    }
    /**
     * @return string
     */
    public function getPortraitPictureName1(): ?string
    {
        return $this->portraitPictureName1;
    }
    /**
     * @param string $portraitPictureName1
     */
    public function setPortraitPictureName1(?string $portraitPictureName1): void
    {
        $this->portraitPictureName1 = $portraitPictureName1;
    }
    /**
     * @return int
     */
    public function getPortraitPictureSize1(): ?int
    {
        return $this->portraitPictureSize1;
    }
    /**
     * @param int $portraitPictureSize1
     */
    public function setPortraitPictureSize1(?int $portraitPictureSize1): void
    {
        $this->portraitPictureSize1 = $portraitPictureSize1;
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedAt1():? \DateTime
    {
        return $this->updatedAt1;
    }
    /**
     * @param \DateTime $updatedAt1
     */
    public function setUpdatedAt1(\DateTime $updatedAt1): void
    {
        $this->updatedAt1 = $updatedAt1;
    }
    /**
     * @return File
     */
    public function getPortraitPictureFile2(): ?File
    {
        return $this->portraitPictureFile2;
    }
    /**
     * @param null|File $portraitPictureName2
     * @throws \Exception
     */
    public function setPortraitPictureFile2(?File $portraitPictureName2 = null): void
    {
        $this->portraitPictureFile2 = $portraitPictureName2;
        if (null !== $portraitPictureName2) {
            $this->updatedAt2 = new \DateTime('now');
        }
    }
    /**
     * @return string
     */
    public function getPortraitPictureName2(): ?string
    {
        return $this->portraitPictureName2;
    }
    /**
     * @param string $portraitPictureName2
     */
    public function setPortraitPictureName2(?string $portraitPictureName2): void
    {
        $this->portraitPictureName2 = $portraitPictureName2;
    }
    /**
     * @return int
     */
    public function getPortraitPictureSize2(): ?int
    {
        return $this->portraitPictureSize2;
    }
    /**
     * @param ?int $portraitPictureSize2
     */
    public function setPortraitPictureSize2(?int $portraitPictureSize2): void
    {
        $this->portraitPictureSize2 = $portraitPictureSize2;
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedAt2(): ?\DateTime
    {
        return $this->updatedAt2;
    }
    /**
     * @param \DateTime $updatedAt2
     */
    public function setUpdatedAt2(\DateTime $updatedAt2): void
    {
        $this->updatedAt2 = $updatedAt2;
    }
    /**
     * @return File
     */
    public function getFullPictureFile(): ?File
    {
        return $this->fullPictureFile;
    }
    /**
     * @param null|File $fullPictureName
     * @throws \Exception
     */
    public function setFullPictureFile(?File $fullPictureName = null): void
    {
        $this->fullPictureFile = $fullPictureName;
        if (null !== $fullPictureName) {
            $this->updatedAt3 = new \DateTime();
        }
    }
    /**
     * @return string
     */
    public function getFullPictureName(): ?string
    {
        return $this->fullPictureName;
    }
    /**
     * @param string $fullPictureName
     */
    public function setFullPictureName(?string $fullPictureName): void
    {
        $this->fullPictureName = $fullPictureName;
    }
    /**
     * @return int
     */
    public function getFullPictureSize(): ?int
    {
        return $this->fullPictureSize;
    }
    /**
     * @param int $fullPictureSize
     */
    public function setFullPictureSize(?int $fullPictureSize): void
    {
        $this->fullPictureSize = $fullPictureSize;
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedAt3(): ?\DateTime
    {
        return $this->updatedAt3;
    }
    /**
     * @param \DateTime $updatedAt3
     */
    public function setUpdatedAt3(\DateTime $updatedAt3): void
    {
        $this->updatedAt3 = $updatedAt3;
    }
    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->birthName;
    }
    /**
     * @return Gender|null
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }
    /**
     * @param Gender|null $gender
     * @return Artist
     */
    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return TextureHair|null
     */
    public function getTextureHair(): ?TextureHair
    {
        return $this->textureHair;
    }
    /**
     * @param TextureHair|null $textureHair
     * @return Artist
     */
    public function setTextureHair(?TextureHair $textureHair): self
    {
        $this->textureHair = $textureHair;
        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return Artist
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @return mixed
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param mixed $progress
     */
    public function setProgress($progress): void
    {
        $this->progress = $progress;
    }

    /**
     *
     * @param  null|File $cvName
     * @throws \Exception
     */
    public function setCvFile(?File $cvName = null): void
    {
        $this->cvFile = $cvName;

        if (null !== $cvName) {
            $this->updatedAt4 = new \DateTime('now');
        }
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function setCvName(?string $cvName): void
    {
        $this->cvName = $cvName;
    }

    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    public function setCvSize(?int $cvSize): void
    {
        $this->cvSize = $cvSize;
    }

    public function getCvSize(): ?int
    {
        return $this->cvSize;
    }
    /**
     *
     * @param  null|File $ribName
     * @throws \Exception
     */
    public function setRibFile(?File $ribName = null): void
    {
        $this->ribFile = $ribName;

        if (null !== $ribName) {
            $this->updatedAt5 = new \DateTime('now');
        }
    }
    /**
     * @return File
     */
    public function getRibFile(): ?File
    {
        return $this->ribFile;
    }
    /**
     * @param string $ribName
     */
    public function setRibName(?string $ribName): void
    {
        $this->ribName = $ribName;
    }
    /**
     * @return string
     */
    public function getRibName(): ?string
    {
        return $this->ribName;
    }
    /**
     * @param int $ribSize
     */
    public function setRibSize(?int $ribSize): void
    {
        $this->ribSize = $ribSize;
    }
    /**
     * @return int
     */
    public function getRibSize(): ?int
    {
        return $this->ribSize;
    }
    /**
     *
     * @param  null|File $socialCardName
     * @throws \Exception
     */
    public function setSocialCardFile(?File $socialCardName = null): void
    {
        $this->socialCardFile = $socialCardName;

        if (null !== $socialCardName) {
            $this->updatedAt6 = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getSocialCardFile(): ?File
    {
        return $this->socialCardFile;
    }

    /**
     * @param string $socialCardName
     */
    public function setSocialCardName(?string $socialCardName): void
    {
        $this->socialCardName = $socialCardName;
    }

    /**
     * @return string
     */
    public function getSocialCardName(): ?string
    {
        return $this->socialCardName;
    }

    public function setSocialCardSize(?int $socialCardSize): void
    {
        $this->socialCardSize = $socialCardSize;
    }

    public function getSocialCardSize(): ?int
    {
        return $this->socialCardSize;
    }
    /**
     *
     * @param  null|File $identityCardName
     * @throws \Exception
     */
    public function setIdentityCardFile(?File $identityCardName = null): void
    {
        $this->identityCardFile = $identityCardName;

        if (null !== $identityCardName) {
            $this->updatedAt7 = new \DateTime('now');
        }
    }

    public function getIdentityCardFile(): ?File
    {
        return $this->identityCardFile;
    }

    public function setIdentityCardName(?string $identityCardName): void
    {
        $this->identityCardName = $identityCardName;
    }

    public function getIdentityCardName(): ?string
    {
        return $this->identityCardName;
    }

    public function setIdentityCardSize(?int $identityCardSize): void
    {
        $this->identityCardSize = $identityCardSize;
    }

    public function getIdentityCardSize(): ?int
    {
        return $this->identityCardSize;
    }
    /**
     *
     * @param  File|null $residencePermitName
     */
    public function setResidencePermitFile(?File $residencePermitName = null): void
    {
        $this->residencePermitFile = $residencePermitName;

        if (null !== $residencePermitName) {
            $this->updatedAt8 = new \DateTime('now');
        }
    }

    public function getResidencePermitFile(): ?File
    {
        return $this->residencePermitFile;
    }

    public function setResidencePermitName(?string $residencePermitName): void
    {
        $this->residencePermitName = $residencePermitName;
    }

    public function getResidencePermitName(): ?string
    {
        return $this->residencePermitName;
    }

    public function setResidencePermitSize(?int $residencePermitSize): void
    {
        $this->residencePermitSize = $residencePermitSize;
    }

    public function getResidencePermitSize(): ?int
    {
        return $this->residencePermitSize;
    }
    /**
     *
     * @param  File|null $cmbName
     */
    public function setCmbFile(?File $cmbName = null): void
    {
        $this->cmbFile = $cmbName;

        if (null !== $cmbName) {
            $this->updatedAt9 = new \DateTime('now');
        }
    }

    public function getCmbFile(): ?File
    {
        return $this->cmbFile;
    }

    public function setCmbName(?string $cmbName): void
    {
        $this->cmbName = $cmbName;
    }

    public function getCmbName(): ?string
    {
        return $this->cmbName;
    }

    public function setCmbSize(?int $cmbSize): void
    {
        $this->cmbSize = $cmbSize;
    }

    public function getCmbSize(): ?int
    {
        return $this->cmbSize;
    }


    public function getLevelDegree(): ?string
    {
        return $this->levelDegree;
    }

    public function setLevelDegree(?string $levelDegree): self
    {
        $this->levelDegree = $levelDegree;

        return $this;
    }

    public function getIntermittent(): ?string
    {
        return $this->intermittent;
    }

    public function setIntermittent(?string $intermittent): self
    {
        $this->intermittent = $intermittent;

        return $this;
    }

    public function getFullName()
    {
        $fullName = $this->getBirthName() . ' ' . $this->getFirstname();

        return $fullName;
    }

    /**
     * @return Collection|Project[]
     */
    public function getCastings(): Collection
    {
        return $this->castings;
    }

    public function addCasting(Project $casting): self
    {
        if (!$this->castings->contains($casting)) {
            $this->castings[] = $casting;
        }

        return $this;
    }

    public function removeCasting(Project $casting): self
    {
        if ($this->castings->contains($casting)) {
            $this->castings->removeElement($casting);
        }

        return $this;
    }
}
