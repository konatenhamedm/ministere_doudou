<?php

namespace App\Entity;

use App\Repository\LigneMissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Entity\Localite;

#[ORM\Entity(repositoryClass: LigneMissionRepository::class)]
class LigneMission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,type: Types::TEXT,name: 'detailsLocalite',options: ['default' => ''])]   
    private ?string $detailsLocalite = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $dateDebutEffectiveLocalite = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $dateFinEffectiveLocalite = null;

    #[ORM\ManyToOne(inversedBy: 'ligneMissions',cascade: ['persist'],targetEntity: Mission::class)]
    private ?Mission $mission = null;

    #[ORM\Column]
    private ?int $nbreJours = null;

    #[ORM\ManyToOne(inversedBy: 'lignemission')]
    private ?Village $village = null;


    public function __construct()
    {
        $this->detailsLocalite = '';
    }
    public function getId(): ?int
    {
        return $this->id;
    }

   


    public function getDetailsLocalite(): ?string
    {
        return $this->detailsLocalite;
    }

    public function setDetailsLocalite(string $detailsLocalite): static
    {
        $this->detailsLocalite = $detailsLocalite;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    // public function getDateDebutEffectiveLocalite(): ?\DateTimeInterface
    // {
    //     return $this->dateDebutEffectiveLocalite;
    // }

    // public function setDateDebutEffectiveLocalite(\DateTimeInterface $dateDebutEffectiveLocalite): static
    // {
    //     $this->dateDebutEffectiveLocalite = $dateDebutEffectiveLocalite;

    //     return $this;
    // }

    // public function getDateFinEffectiveLocalite(): ?\DateTimeInterface
    // {
    //     return $this->dateFinEffectiveLocalite;
    // }

    // public function setDateFinEffectiveLocalite(\DateTimeInterface $dateFinEffectiveLocalite): static
    // {
    //     $this->dateFinEffectiveLocalite = $dateFinEffectiveLocalite;

    //     return $this;
    // }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getNbreJours(): ?int
    {
        return $this->nbreJours;
    }

    public function setNbreJours(int $nbreJours): static
    {
        $this->nbreJours = $nbreJours;

        return $this;
    }

    public function getVillage(): ?Village
    {
        return $this->village;
    }

    public function setVillage(?Village $village): static
    {
        $this->village = $village;

        return $this;
    }
}
