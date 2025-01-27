<?php

namespace App\Entity;

use App\Repository\InfoRapportageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoRapportageRepository::class)]
class InfoRapportage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroCr = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $typeCr = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Reunion $reunion = null;

    #[ORM\ManyToOne(inversedBy: 'infoRapportages')]
    private ?Employe $rapporteur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCr = null;




    public function __construct()
    {
        $this->dateCr = new \DateTime();
        $this->setTypeCr(0);
        // $this->setEtat(0);
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCr(): ?string
    {
        return $this->numeroCr;
    }

    public function setNumeroCr(string $numeroCr): static
    {
        $this->numeroCr = $numeroCr;

        return $this;
    }

    public function getTypeCr(): ?int
    {
        return $this->typeCr;
    }

    public function setTypeCr(int $typeCr): static
    {
        $this->typeCr = $typeCr;

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

    public function getRapporteur(): ?Employe
    {
        return $this->rapporteur;
    }

    public function setRapporteur(?Employe $rapporteur): static
    {
        $this->rapporteur = $rapporteur;

        return $this;
    }

    public function getDateCr(): ?\DateTimeInterface
    {
        return $this->dateCr;
    }

    public function setDateCr(\DateTimeInterface $dateCr): static
    {
        $this->dateCr = $dateCr;

        return $this;
    }
}
