<?php

namespace App\Entity;

use App\Repository\EtatStockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatStockRepository::class)]
class EtatStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite_init = null;

    #[ORM\Column]
    private ?int $quantite_rest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteInit(): ?int
    {
        return $this->quantite_init;
    }

    public function setQuantiteInit(int $quantite_init): static
    {
        $this->quantite_init = $quantite_init;

        return $this;
    }

    public function getQuantiteRest(): ?int
    {
        return $this->quantite_rest;
    }

    public function setQuantiteRest(int $quantite_rest): static
    {
        $this->quantite_rest = $quantite_rest;

        return $this;
    }
}
