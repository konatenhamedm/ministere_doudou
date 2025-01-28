<?php

namespace App\Entity;

use App\Repository\LigneDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneDemandeRepository::class)]
class LigneDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneDemandes', cascade: ['persist'])]
    private ?Demande $demande = null;

    #[ORM\Column]
    private ?int $quantiteDemandee = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteValidee = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteRecue = null;

    #[ORM\ManyToOne(inversedBy: 'Lignedemande', cascade: ['persist'])]
    private ?Article $article = null;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemande(): ?Demande
    {
        return $this->demande;
    }

    public function setDemande(?Demande $demande): static
    {
        $this->demande = $demande;

        return $this;
    }

    public function getQuantiteDemandee(): ?int
    {
        return $this->quantiteDemandee;
    }

    public function setQuantiteDemandee(int $quantiteDemandee): static
    {
        $this->quantiteDemandee = $quantiteDemandee;

        return $this;
    }

    public function getQuantiteValidee(): ?int
    {
        return $this->quantiteValidee;
    }

    public function setQuantiteValidee(int $quantiteValidee): static
    {
        $this->quantiteValidee = $quantiteValidee;

        return $this;
    }

    public function getQuantiteRecue(): ?int
    {
        return $this->quantiteRecue;
    }

    public function setQuantiteRecue(int $quantiteRecue): static
    {
        $this->quantiteRecue = $quantiteRecue;

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

    
}
