<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $etatPresence = null;

    #[ORM\Column(length: 255)]
    private ?string $libPresence = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?Reunion $reunion = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?Employe $employe = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Rapportage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pointAborde = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recommendationRapport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEtatPresence(): ?bool
    {
        return $this->etatPresence;
    }

    public function setEtatPresence(bool $etatPresence): static
    {
        $this->etatPresence = $etatPresence;

        return $this;
    }

    public function getLibPresence(): ?string
    {
        return $this->libPresence;
    }

    public function setLibPresence(string $libPresence): static
    {
        $this->libPresence = $libPresence;

        return $this;
    }

    public function getReunion(): ?Reunion
    {
        return $this->reunion;
    }

    public function setReunion(?Reunion $reunion): static
    {
        $this->reunion = $reunion;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): static
    {
        $this->employe = $employe;

        return $this;
    }

    public function getRapportage(): ?string
    {
        return $this->Rapportage;
    }

    public function setRapportage(string $Rapportage): static
    {
        $this->Rapportage = $Rapportage;

        return $this;
    }

    public function getPointAborde(): ?string
    {
        return $this->pointAborde;
    }

    public function setPointAborde(string $pointAborde): static
    {
        $this->pointAborde = $pointAborde;

        return $this;
    }

    public function getRecommendationRapport(): ?string
    {
        return $this->recommendationRapport;
    }

    public function setRecommendationRapport(string $recommendationRapport): static
    {
        $this->recommendationRapport = $recommendationRapport;

        return $this;
    }
}
