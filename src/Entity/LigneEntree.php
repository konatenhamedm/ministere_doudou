<?php

namespace App\Entity;

use App\Repository\LigneEntreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneEntreeRepository::class)]
class LigneEntree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneEntrees')]
    private ?Entree $entree = null;

    #[ORM\ManyToOne(inversedBy: 'ligneEntrees')]
    private ?Article $article = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntree(): ?Entree
    {
        return $this->entree;
    }

    public function setEntree(?Entree $entree): static
    {
        $this->entree = $entree;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
