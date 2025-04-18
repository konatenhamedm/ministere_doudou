<?php

namespace App\Entity;

use App\Repository\DiligenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiligenceRepository::class)]
class Diligence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTraitementDiligence = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaireDiligence = null;

    // #[ORM\ManyToOne(inversedBy: 'diligences', cascade: ['persist'])]
    // private ?Reunion $reunion = null;


    #[ORM\Column(length: 255)]
    private ?string $etat = 'en_cours';

    #[ORM\ManyToOne(inversedBy: 'diligences', cascade: ['persist'])]
    private ?OrdreJour $points = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTraitementDiligence(): ?\DateTimeInterface
    {
        return $this->dateTraitementDiligence;
    }

    public function setDateTraitementDiligence(\DateTimeInterface $dateTraitementDiligence): static
    {
        $this->dateTraitementDiligence = $dateTraitementDiligence;

        return $this;
    }

    public function getCommentaireDiligence(): ?string
    {
        return $this->commentaireDiligence;
    }

    public function setCommentaireDiligence(string $commentaireDiligence): static
    {
        $this->commentaireDiligence = $commentaireDiligence;

        return $this;
    }

    // public function getReunion(): ?Reunion
    // {
    //     return $this->reunion;
    // }

    // public function setReunion(?Reunion $reunion): static
    // {
    //     $this->reunion = $reunion;

    //     return $this;
    // }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPoints(): ?OrdreJour
    {
        return $this->points;
    }

    public function setPoints(?OrdreJour $points): static
    {
        $this->points = $points;

        return $this;
    }
}
