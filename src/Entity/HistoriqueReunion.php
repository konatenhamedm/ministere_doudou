<?php

namespace App\Entity;

use App\Repository\HistoriqueReunionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueReunionRepository::class)]
class HistoriqueReunion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHistorique = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueReunions')]
    private ?Reunion $reunion = null;

    public function __construct()
    {
        $this->dateHistorique = new \DateTime();

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateHistorique(): ?\DateTimeInterface
    {
        return $this->dateHistorique;
    }

    public function setDateHistorique(\DateTimeInterface $dateHistorique): static
    {
        $this->dateHistorique = $dateHistorique;

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
}
