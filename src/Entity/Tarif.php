<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pourcentageAvance = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $montantParticipant = null;

    #[ORM\Column(length: 255)]
    private ?string $emailOM = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPourcentageAvance(): ?string
    {
        return $this->pourcentageAvance;
    }

    public function setPourcentageAvance(string $pourcentageAvance): static
    {
        $this->pourcentageAvance = $pourcentageAvance;

        return $this;
    }

    public function getMontantParticipant(): ?string
    {
        return $this->montantParticipant;
    }

    public function setMontantParticipant(string $montantParticipant): static
    {
        $this->montantParticipant = $montantParticipant;

        return $this;
    }

    public function getEmailOM(): ?string
    {
        return $this->emailOM;
    }

    public function setEmailOM(string $emailOM): static
    {
        $this->emailOM = $emailOM;

        return $this;
    }
}
