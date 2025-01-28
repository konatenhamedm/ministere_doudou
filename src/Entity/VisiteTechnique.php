<?php

namespace App\Entity;

use App\Repository\VisiteTechniqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteTechniqueRepository::class)]
class VisiteTechnique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'visiteTechniques', cascade: ['persist'])]
    private ?Vehicule $vehicule = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDerniereVisite = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateProchaineVisite = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $observation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getDateDerniereVisite(): ?\DateTimeInterface
    {
        return $this->dateDerniereVisite;
    }

    public function setDateDerniereVisite(\DateTimeInterface $dateDerniereVisite): static
    {
        $this->dateDerniereVisite = $dateDerniereVisite;

        return $this;
    }

    public function getDateProchaineVisite(): ?\DateTimeInterface
    {
        return $this->dateProchaineVisite;
    }

    public function setDateProchaineVisite(\DateTimeInterface $dateProchaineVisite): static
    {
        $this->dateProchaineVisite = $dateProchaineVisite;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }
}
