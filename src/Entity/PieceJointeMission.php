<?php

namespace App\Entity;

use App\Repository\PieceJointeMissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceJointeMissionRepository::class)]
class PieceJointeMission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pieceJointeMissions')]
    private ?Mission $mission = null;

    #[ORM\ManyToOne(inversedBy: 'pieceJointeMissions')]
    private ?TypeFichier $typeFichier = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFichier = null;

    #[ORM\ManyToOne(inversedBy: 'pieceJointes')]
    private ?Mission $missions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getTypeFichier(): ?TypeFichier
    {
        return $this->typeFichier;
    }

    public function setTypeFichier(?TypeFichier $typeFichier): static
    {
        $this->typeFichier = $typeFichier;

        return $this;
    }

    public function getDateFichier(): ?\DateTimeInterface
    {
        return $this->dateFichier;
    }

    public function setDateFichier(\DateTimeInterface $dateFichier): static
    {
        $this->dateFichier = $dateFichier;

        return $this;
    }

    public function getMissions(): ?Mission
    {
        return $this->missions;
    }

    public function setMissions(?Mission $missions): static
    {
        $this->missions = $missions;

        return $this;
    }
}
