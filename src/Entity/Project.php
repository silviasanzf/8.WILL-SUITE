<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shootingDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $production;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $broadcast;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $segmentNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $executiveProduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delegatedProduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $producer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $executiveProducer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $director;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productionManager;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productionAdministrator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productionAssistant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $castingDirector;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distributionDirector;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $castingAssistant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $leadAssistant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $support;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", inversedBy="projects")
     */
    private $artists;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductionCompagny", inversedBy="project")
     */
    private $productionCompagny;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="castings")
     */
    private $candidates;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->candidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShootingDate(): ?string
    {
        return $this->shootingDate;
    }

    public function setShootingDate(string $shootingDate): self
    {
        $this->shootingDate = $shootingDate;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getProduction(): ?string
    {
        return $this->production;
    }

    public function setProduction(string $production): self
    {
        $this->production = $production;

        return $this;
    }

    public function getBroadcast(): ?string
    {
        return $this->broadcast;
    }

    public function setBroadcast(string $broadcast): self
    {
        $this->broadcast = $broadcast;

        return $this;
    }

    public function getSegmentNumber(): ?string
    {
        return $this->segmentNumber;
    }

    public function setSegmentNumber(string $segmentNumber): self
    {
        $this->segmentNumber = $segmentNumber;

        return $this;
    }

    public function getExecutiveProduction(): ?string
    {
        return $this->executiveProduction;
    }

    public function setExecutiveProduction(string $executiveProduction): self
    {
        $this->executiveProduction = $executiveProduction;

        return $this;
    }

    public function getDelegatedProduction(): ?string
    {
        return $this->delegatedProduction;
    }

    public function setDelegatedProduction(string $delegatedProduction): self
    {
        $this->delegatedProduction = $delegatedProduction;

        return $this;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function setSponsor(string $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(string $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    public function getExecutiveProducer(): ?string
    {
        return $this->executiveProducer;
    }

    public function setExecutiveProducer(string $executiveProducer): self
    {
        $this->executiveProducer = $executiveProducer;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getProductionManager(): ?string
    {
        return $this->productionManager;
    }

    public function setProductionManager(string $productionManager): self
    {
        $this->productionManager = $productionManager;

        return $this;
    }

    public function getProductionAdministrator(): ?string
    {
        return $this->productionAdministrator;
    }

    public function setProductionAdministrator(string $productionAdministrator): self
    {
        $this->productionAdministrator = $productionAdministrator;

        return $this;
    }

    public function getProductionAssistant(): ?string
    {
        return $this->productionAssistant;
    }

    public function setProductionAssistant(string $productionAssistant): self
    {
        $this->productionAssistant = $productionAssistant;

        return $this;
    }

    public function getCastingDirector(): ?string
    {
        return $this->castingDirector;
    }

    public function setCastingDirector(string $castingDirector): self
    {
        $this->castingDirector = $castingDirector;

        return $this;
    }

    public function getDistributionDirector(): ?string
    {
        return $this->distributionDirector;
    }

    public function setDistributionDirector(string $distributionDirector): self
    {
        $this->distributionDirector = $distributionDirector;

        return $this;
    }

    public function getCastingAssistant(): ?string
    {
        return $this->castingAssistant;
    }

    public function setCastingAssistant(string $castingAssistant): self
    {
        $this->castingAssistant = $castingAssistant;

        return $this;
    }

    public function getLeadAssistant(): ?string
    {
        return $this->leadAssistant;
    }

    public function setLeadAssistant(string $leadAssistant): self
    {
        $this->leadAssistant = $leadAssistant;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->contains($artist)) {
            $this->artists->removeElement($artist);
        }

        return $this;
    }

    public function getProductionCompagny(): ?ProductionCompagny
    {
        return $this->productionCompagny;
    }

    public function setProductionCompagny(?ProductionCompagny $productionCompagny): self
    {
        $this->productionCompagny = $productionCompagny;

        return $this;
    }

    public function __toString()
    {
        return $this->title; // voir autres
    }

    /**
     * @return Collection|Artist[]
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(Artist $candidate): self
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates[] = $candidate;
            $candidate->addCasting($this);
        }

        return $this;
    }

    public function removeCandidate(Artist $candidate): self
    {
        if ($this->candidates->contains($candidate)) {
            $this->candidates->removeElement($candidate);
            $candidate->removeCasting($this);
        }

        return $this;
    }
}
