<?php

namespace App\Entity;

use App\Repository\VillageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VillageRepository::class)]
class Village
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\Column(length: 255)]
    // private ?string $code = null;

    // #[ORM\Column(length: 255)]
    // private ?string $abrege = null;

    #[ORM\ManyToOne(inversedBy: 'villages')]
    private ?SousPrefecture $sousPrefecture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    // public function getCode(): ?string
    // {
    //     return $this->code;
    // }

    // public function setCode(string $code): static
    // {
    //     $this->code = $code;

    //     return $this;
    // }

    // public function getAbrege(): ?string
    // {
    //     return $this->abrege;
    // }

    // public function setAbrege(string $abrege): static
    // {
    //     $this->abrege = $abrege;

    //     return $this;
    // }

    public function getSousPrefecture(): ?SousPrefecture
    {
        return $this->sousPrefecture;
    }

    public function setSousPrefecture(?SousPrefecture $sousPrefecture): static
    {
        $this->sousPrefecture = $sousPrefecture;

        return $this;
    }
}
